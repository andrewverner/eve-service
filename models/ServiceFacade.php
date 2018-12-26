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
     * @return CharacterService|null
     */
    public static function getSkillQueueNotifier(Character $character)
    {
        return CharacterService::find()->where([
            'service_id' => 1,
            'character_id' => $character->characterId,
        ])->one();
    }
}
