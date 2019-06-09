<?php

namespace app\controllers;

use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;
use yii\web\Controller;

class MapController extends Controller
{
    public function actionIndex()
    {
        $solarSystemsIds = EVE::universe()->solarSystems();
        $solarSystemsIds = array_filter($solarSystemsIds, function ($solarSystemId) {
            return $solarSystemId < 32000001;
        });
        //$solarSystemsIds = array_slice($solarSystemsIds, 0, 1500);

        /**
         * @var SolarSystem[] $solarSystems
         */
        $solarSystems = [];
        $x = $y = $z = [];
        foreach ($solarSystemsIds as $solarSystemsId) {
            $solarSystem = EVE::universe()->solarSystem($solarSystemsId);
            $solarSystems[] = $solarSystem;
            $x[] = $solarSystem->position['x'];
            $y[] = $solarSystem->position['y'];
            $z[] = $solarSystem->position['z'];
        }

        $relations = [];
        foreach ($solarSystems as $solarSystem) {
            if (!$solarSystem->getStargates()) {
                continue;
            }

            foreach ($solarSystem->getStargates() as $stargate) {
                if (
                    isset($relations["{$solarSystem->systemId}:{$stargate->destination->systemId}"])
                    || isset($relations["{$stargate->destination->systemId}:{$solarSystem->systemId}"])
                ) {
                    continue;
                }

                $relations["{$solarSystem->systemId}:{$stargate->destination->systemId}"] = [
                    'from' => $solarSystem->position,
                    'to' => EVE::universe()->solarSystem($stargate->destination->systemId)->position,
                ];
            }
        }

        //$this->getView()->registerJsVar('solarSystems', $solarSystems);
        $minX = abs(min($x))/100000000000000;
        $minZ = abs(min($z))/100000000000000;

        return $this->render('index', [
            'solarSystems' => $solarSystems,
            'relations' => $relations,
            'minX' => $minX,
            'minZ' => $minZ,

            'width' => max($x)/100000000000000 + $minX,
            'height' => max($z)/100000000000000 + $minZ,
        ]);
    }
}
