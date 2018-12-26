<?php

namespace app\models;

use app\models\tasks\EmailTask;
use app\models\tasks\SkillQueueNotificatorEmail;
use app\models\tasks\Task;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use yii\db\Expression;

/**
 * This is the model class for table "queue_tasks".
 *
 * @property integer $id
 * @property string $type
 * @property string $body
 * @property integer $status
 * @property string $message
 * @property integer $tries
 * @property string $created
 * @property string $executed
 * @property string $updated
 */
class QueueTasks extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_ERROR = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'queue_tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['body'], 'string'],
            [['status', 'tries'], 'integer'],
            [['created', 'executed', 'updated'], 'safe'],
            [['type'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'body' => 'Body',
            'status' => 'Status',
            'message' => 'Message',
            'tries' => 'Tries',
            'created' => 'Created',
            'executed' => 'Executed',
            'updated' => 'Updated',
        ];
    }

    public static function add(Task $task)
    {
        $model = new static;
        $model->type = $task->getQueueName();
        $model->body = serialize($task->getData());
        if ($model->validate()) {
            $model->save();
            $model->publish();
        }
    }

    private function publish()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare($this->type, false, false, false, false);
        $msg = new AMQPMessage($this->id);
        $channel->basic_publish($msg, '', $this->type);
        $channel->close();
        $connection->close();
    }

    /**
     * @return Task|null
     */
    private function getTask()
    {
        switch ($this->type) {
            case 'skill-queue-notificator':
                $task = new SkillQueueNotificatorEmail();
                $task->populate(unserialize($this->body));
                return $task;
                break;
            case 'email':
                $task = new EmailTask();
                $task->populate(unserialize($this->body));
                return $task;
                break;
            default:
                return null;
        }
    }

    /**
     * @return bool
     */
    public function consume()
    {
        $task = $this->getTask();
        if (!$task) {
            return false;
        }

        $this->tries++;
        $this->updated = new Expression('NOW()');
        $this->status = self::STATUS_IN_PROGRESS;
        $this->save();

        if ($task->process()) {
            $this->executed = new Expression('NOW()');
            $this->status = self::STATUS_COMPLETE;
        } else {
            $this->status = self::STATUS_ERROR;
        }
        $this->save();
    }
}
