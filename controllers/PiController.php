<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:46
 */

namespace app\controllers;

use app\components\pi\BarrenPlanet;
use app\components\pi\GasPlanet;
use app\components\pi\IcePlanet;
use app\components\pi\LavaPlanet;
use app\components\pi\OceanicPlanet;
use app\components\pi\Planet;
use app\components\pi\Planetary;
use app\components\pi\PlasmaPlanet;
use app\components\pi\StormPlanet;
use app\components\pi\TemperatePlanet;
use yii\web\Controller;

class PiController extends Controller
{
    public function actionIndex()
    {
        $data = \Yii::$app->request->getQueryParam('planets');
        if ($data) {
            $planets = [
                new BarrenPlanet(),
                new GasPlanet(),
                new IcePlanet(),
                new LavaPlanet(),
                new OceanicPlanet(),
                new PlasmaPlanet(),
                new StormPlanet(),
                new TemperatePlanet()
            ];
            $planets = array_filter($planets, function ($planet) use ($data) {
                /**
                 * @var Planet $planet
                 */
                return in_array((new \ReflectionClass($planet))->getShortName(), $data);
            });
            $planetary = new Planetary();
            $planetary->addPlanet($planets);
            $planetary->explore();
        }

        return $this->render('index', ['planetary' => $planetary ?? null]);
    }
}
