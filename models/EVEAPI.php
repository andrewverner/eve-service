<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 16:08
 */

namespace app\models;

class EVEAPI
{
    private static $api;

    public static function api()
    {
        if (!self::$api) {
            self::$api = new \DenisKhodakovskiyESI\EVESwaggerAPI(
                \Yii::$app->params['esi']['clientId'],
                \Yii::$app->params['esi']['secretKey'],
                \Yii::$app->params['esi']['callback']
            );
        }

        return self::$api;
    }
}
