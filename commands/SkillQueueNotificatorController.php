<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 12:15
 */

namespace app\commands;

use app\models\Scope;
use app\models\Service;
use app\models\services\SkillQueueNotificator;
use app\models\Token;

class SkillQueueNotificatorController extends ConsoleController
{
    public $characterId;
    public $force;

    public function options($actionID)
    {
        return ['characterId', 'force'];
    }

    public function optionAliases()
    {
        return [
            'id' => 'characterId',
            'f' => 'force',
        ];
    }

    public function actionCheck()
    {
        $token = Token::findOne(6);
        \Yii::$app->mailer->compose()
            ->setTo('denis.khodakovskiy@gmail.com')
            ->setSubject('Skill queue ends soon')
            ->setHtmlBody($this->renderPartial('skill-queue', [
                'queue' => $token->character()->skillQueue(),
                'character' => $token->character(),
            ]))
            ->send();
        die();

        $params = ['service_code' => Service::SERVICE_SKILL_QUEUE_NOTIFIER];
        if ($this->characterId) {
            $params['character_id'] = $this->characterId;
        }

        /**
         * @var Service[] $models
         */
        $models = Service::find()->where($params)->all();
        if (!$models) {
            $this->logInfo('Nothing to do');
        }

        foreach ($models as $service) {
            $this->logInfo(str_pad($service->character_id, '50', '-', STR_PAD_BOTH));

            /**
             * @var Token $token
             */
            $token = Token::find()->where(['character_id' => $service->character_id])->one();
            if (!$token) {
                $this->logError('Token not found');
                continue;
            }

            if ($service->isExpired() && !$this->force) {
                $this->logWarning('Service is expired');
                continue;
            }

            if (!$token->can(Scope::SCOPE_SKILL_QUEUE_READ)) {
                $this->logError('Scope is invalid');
                continue;
            }

            $character = $token->character();
            $queue = $character->skillQueue();

            if (!$queue) {
                $this->logWarning("Skill queue for {$character->name} is empty");
                continue;
            }

            $lastSkill = end($queue);
            $diff = $lastSkill->finishDate->diff(new \DateTime());

            /**
             * @var SkillQueueNotificator $serviceSettings
             */
            $serviceSettings = $service->settings();
            $this->logInfo("Settings: -period={$serviceSettings->period} -email={$serviceSettings->email}");

            \Yii::$app->mailer->compose('layouts/html')
                ->setTo($serviceSettings->email)
                ->setSubject('Skill queue ends soon')
                ->send();

            $this->logInfo("Skill queue for {$character->name} ends in {$diff->days}");
        }

        $this->logSuccess('Done');
    }
}
