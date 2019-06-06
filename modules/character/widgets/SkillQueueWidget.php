<?php

namespace app\modules\character\widgets;

use app\models\Scope;
use Yii;
use app\models\Token;
use yii\base\Widget;

class SkillQueueWidget extends Widget
{
    public function run()
    {
        /**
         * @var Token $token
         */
        $token = Yii::$app->character->token;

        if (!$token || !$token->can(Scope::SCOPE_SKILL_QUEUE_READ)) {
            return;
        }

        return $this->render('skill-queue', ['queue' => $token->character()->skillQueue()]);
    }
}
