<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\queue\Queue;
use app\components\queue\SkillQueueNotificatorTask;
use app\models\QueueTasks;
use app\models\Token;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionQueue()
    {
        $this->layout = false;
        $token = Token::findOne(6);
        return $this->render('skill-queue', [
            'queue' => $token->character()->skillQueue(),
            'character' => $token->character(),
        ]);
    }

    public function actionT()
    {
        $token = Token::findOne(6);
        $queue = $token->character()->skillQueue();
        $lastSkill = end($queue);
        $diff = $lastSkill->finishDate->diff(new \DateTime());

        $task = new SkillQueueNotificatorTask();
        $task->to = ['denis.khodakovskiy@gmail.com'];
        $task->subject = 'Character\'s skill queue ends soon';
        $task->body = $this->renderPartial('skill-queue', [
            'queue' => $token->character()->skillQueue(),
            'character' => $token->character(),
            'lastSkill' => $lastSkill,
            'diff' => $diff,
        ]);

        $task->publish();
    }
}
