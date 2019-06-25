<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 24.12.18
 * Time: 15:01
 */

namespace app\models\services;

use app\models\CharacterService;

class ServiceSetting
{
    public function attributes()
    {
        return [];
    }

    public function __construct(CharacterService $service = null)
    {
        if ($service->settings) {
            foreach (unserialize($service->settings) as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}
