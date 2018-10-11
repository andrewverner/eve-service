<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 13:58
 */

namespace app\widgets;

use yii\base\Widget;

class SkillQueueWidget extends Widget
{
    public $queue;

    public function run()
    {
        return $this->render('skill-queue', ['queue' => $this->queue]);
    }
}
