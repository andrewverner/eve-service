<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 25.12.18
 * Time: 16:37
 */

namespace app\commands;

use yii\console\Controller;

class QueueConsumerController extends Controller
{
    public function actionSkillQueueNotificator()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false, false, false);
    }
}
