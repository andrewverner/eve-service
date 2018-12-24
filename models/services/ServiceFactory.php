<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 14:54
 */

namespace app\models\services;

use app\models\Service;

class ServiceFactory
{
    /**
     * @param Service $service
     * @return ServiceSetting
     */
    public static function initService(Service $service)
    {
        $funcName = lcfirst(str_replace('-', '', ucwords($service->service_code, '-')));
        return self::$funcName($service);
    }

    /**
     * @param Service $service
     * @return SkillQueueNotificator|ServiceSetting
     */
    public static function skillQueueNotifier(Service $service)
    {
        return new SkillQueueNotificator($service);
    }
}
