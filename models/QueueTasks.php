<?php

namespace app\models;

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
}
