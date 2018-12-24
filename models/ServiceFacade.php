<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 11:50
 */

namespace app\models;

use app\components\esi\character\Character;

class ServiceFacade
{
    /**
     * @param Character $character
     * @return Service|null
     */
    public static function getSkillQueueNotifier(Character $character)
    {
        return Service::find()->where([
            'service_code' => Service::SERVICE_SKILL_QUEUE_NOTIFIER,
            'character_id' => $character->characterId,
        ])->one();
    }
}
