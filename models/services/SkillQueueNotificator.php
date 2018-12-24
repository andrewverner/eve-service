<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 12:12
 */

namespace app\models\services;

class SkillQueueNotificator extends ServiceSetting
{
    /**
     * @var int
     */
    public $period;

    /**
     * @var string
     */
    public $email;
}
