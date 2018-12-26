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
     * @param CharacterService $service
     * @return ServiceSetting
     */
    public static function initService(CharacterService $service)
    {
        $funcName = lcfirst(str_replace('-', '', ucwords($service->service_code, '-')));
        return self::$funcName($service);
    }

    /**
     * @param CharacterService $service
     * @return SkillQueueNotificator|ServiceSetting
     */
    public static function skillQueueNotifier(CharacterService $service)
    {
        return new SkillQueueNotificator($service);
    }
}
