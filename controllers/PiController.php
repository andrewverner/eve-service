<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:46
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\components\pi\Planet;
use app\components\pi\Planetary;
use app\components\pi\planets\BarrenPlanet;
use app\components\pi\planets\GasPlanet;
use app\components\pi\planets\IcePlanet;
use app\components\pi\planets\LavaPlanet;
use app\components\pi\planets\OceanicPlanet;
use app\components\pi\planets\PlasmaPlanet;
use app\components\pi\planets\StormPlanet;
use app\components\pi\planets\TemperatePlanet;
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

        $this->view->registerJsVar('schemas', Planetary::getSchemas());

        return $this->render('index', [
            'planetary' => $planetary ?? null,
            'planets' => $planets ?? null,
        ]);
    }

    public function actionSchematic($id)
    {
        $config = [
            'chart' => [
                'container' => '#schematic',
                'connectors' => [
                    'type' => 'step',
                    'style' => [
                        'stroke' => '#aaa'
                    ]
                ]
            ],
            'nodeStructure' => Planetary::nodeTree($id)
        ];

        \Yii::$app->view->registerJsVar('chartConfig', $config);

        return $this->render('schematic', ['type' => EVE::universe()->type($id)]);
    }
}
