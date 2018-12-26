<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.12.18
 * Time: 16:37
 */

namespace app\commands;

use app\models\QueueTasks;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use yii\console\Controller;

class QueueConsumerController extends Controller
{


    public function actionRun($queueName)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare($queueName, false, false, false, false);

        $callback = function ($msg) {
            QueueTasks::findOne($msg->body)->consume();
        };
        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }
}
