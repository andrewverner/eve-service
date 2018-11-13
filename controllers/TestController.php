<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\models\CharacterRoute;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionRouteHash()
    {
        $models = CharacterRoute::find()->all();
        foreach ($models as $model) {
            $model->hash = substr(md5($model->character_id . time() . uniqid() . md5($model->route)) . md5($model->route . time()), 0, 64);
            if ($model->validate()) {
                $model->save();
            }
        }
    }

    public function actionMarket()
    {
        EVE::market()->prices();
    }
}
