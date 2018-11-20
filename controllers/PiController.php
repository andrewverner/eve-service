<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:46
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\components\esi\SearchFactory;
use app\components\Html;
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
use yii\web\NotFoundHttpException;

class PiController extends Controller
{
    public function actionShort()
    {
        $mask = null;
        $data = \Yii::$app->request->getQueryParam('planets');
        if ($data) {
            $mask = 0;
            foreach ($data as $planetType) {
                $planet = (new \ReflectionClass('app\components\pi\planets\\' . $planetType))->newInstance();
                $mask += $planet->getMask();
            }
        }

        return $this->redirect(\Yii::$app->urlManager->createUrl("/pi/{$mask}"));
    }

    public function actionSearchSystem()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('Page not found');
        }

        $solarSystemName = \Yii::$app->request->getQueryParam('name');
        $mask = null;
        if ($solarSystemName && strlen($solarSystemName) >= 3) {
            $solarSystems = EVE::universe()->search(
                $solarSystemName, [SearchFactory::CATEGORY_SOLAR_SYSTEM]
            )->solarSystem;
            if ($solarSystems) {
                return $this->renderPartial('solar-systems-list', [
                    'solarSystems' => $solarSystems
                ]);
            } else {
                return Html::tag('p', 'Result list is empty');
            }
        }
    }

    public function actionIndex($mask = null)
    {
        if ($mask) {
            if ($mask > 255) {
                $solarSystem = EVE::universe()->solarSystem($mask);
                $mask = $solarSystem ? Planetary::getSolarSystemPlanetsMask($solarSystem) : 0;
            }

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
            $planets = array_filter($planets, function ($planet) use ($mask) {
                /**
                 * @var Planet $planet
                 */
                return $mask & $planet->getMask();
            });
            $planetary = new Planetary();
            $planetary->addPlanet($planets);
            $planetary->explore();
        }

        $this->view->registerJsVar('schemas', Planetary::getSchemas());

        return $this->render('index', [
            'planetary' => $planetary ?? null,
            'planets' => $planets ?? null,
            'mask' => $mask,
            'solarSystem' => $solarSystem ?? null
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
