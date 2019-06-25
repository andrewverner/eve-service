<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 12:15
 */

namespace app\commands;

use app\models\QueueTasks;
use app\models\Scope;
use app\models\CharacterService;
use app\models\Service;
use app\models\services\SkillQueueNotificatorSettings;
use app\models\tasks\SkillQueueNotificatorEmail;
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

    public function actionRun()
    {
        /**
         * @var Service $service
         */
        $service = Service::find()->where(['code' => Service::SKILL_QUEUE_NOTIFICATOR])->one();
        $characterServices = CharacterService::findOne(['service_id' => $service->id]);
        if (!$queue = $characterServices->token->character()->skillQueue()) {

        }
    }

    public function actionCheck()
    {
        $params = ['service_id' => 1];
        if ($this->characterId) {
            $params['character_id'] = $this->characterId;
        }

        /**
         * @var CharacterService[] $models
         */
        $models = CharacterService::find()->where($params)->all();
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

            if (!$queue || empty($queue)) {
                $this->logWarning("Skill queue for {$character->name} is empty");
                continue;
            }

            $lastSkill = end($queue);
            $diff = $lastSkill->finishDate->diff(new \DateTime());

            /**
             * @var SkillQueueNotificatorSettings $serviceSettings
             */
            $serviceSettings = $service->settings();
            $this->logInfo("Settings: -period={$serviceSettings->period} -email={$serviceSettings->email}");
            $this->logInfo("Skill queue for {$character->name} ends in {$diff->days} d");

            if ($diff->days <= $serviceSettings->period && $diff->days >= $serviceSettings->period - 2) {
                $this->logInfo("Sending notification to {$serviceSettings->email}");
                $task = new SkillQueueNotificatorEmail();
                $task->to = $serviceSettings->email;
                $task->subject = 'EVE Services: Skill queue ends soon';
                $task->body = $this->renderPartial('/email/skill-queue', [
                    'queue' => $token->character()->skillQueue(),
                    'character' => $token->character(),
                    'lastSkill' => $lastSkill,
                    'diff' => $diff,
                ]);
                QueueTasks::add($task);
            }
        }

        $this->logSuccess('Done');
    }
}
