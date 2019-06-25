<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 14:54
 */

namespace app\models\services;

use app\models\CharacterService;

class ServiceFactory
{
    /**
     * @param CharacterService|null $service
     * @return ServiceSetting
     */
    public static function initService(CharacterService $service)
    {
        $funcName = lcfirst(str_replace('-', '', ucwords($service->service->code, '-')));
        return self::$funcName($service);
    }

    /**
     * @param CharacterService $service
     * @return SkillQueueNotificatorSettings|ServiceSetting
     */
    public static function skillQueueNotificator(CharacterService $service)
    {
        return new SkillQueueNotificatorSettings($service);
    }
}
