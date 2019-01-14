<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.12.18
 * Time: 14:34
 */

namespace app\commands;

use app\models\QueueTasks;
use app\models\tasks\SkillQueueNotificatorEmail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class TestController extends ConsoleController
{
    public function actionRabbitPublish()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');
        $this->logInfo('Message has been published');
        $channel->close();
        $connection->close();
    }

    public function actionRabbitConsume()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        $callback = function ($msg) {
            Logger::log($msg->body, 'rabbit');
        };
        $channel->basic_consume('hello', '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }
    }

    public function actionQueue()
    {
        $task = (new SkillQueueNotificatorEmail())
            ->to('denis.khodakovskiy@gmail.com')
            ->subject('Queue test')
            ->body('Queue test body');
        QueueTasks::add($task);
    }
}
