<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.12.18
 * Time: 8:01
 */

namespace app\models\tasks;

class SkillQueueNotificatorEmail extends EmailTask
{
    public function getQueueName()
    {
        return 'skill-queue-notificator';
    }
}
