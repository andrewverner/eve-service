<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.06.19
 * Time: 10:41
 */

namespace app\controllers;

use app\components\esi\EVE;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UniverseController extends Controller
{
    public function actionSolarSystem($id)
    {
        $solarSystem = EVE::universe()->solarSystem($id);
        if (!$solarSystem) {
            throw new NotFoundHttpException('Solar system not found');
        }

        return $this->render('solar-system', ['solarSystem' => $solarSystem]);
    }
}
