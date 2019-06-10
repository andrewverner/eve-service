<?php

namespace app\controllers;

use app\components\esi\EVE;
use app\components\esi\helpers\EVEFormatter;
use app\components\esi\universe\SolarSystem;
use app\components\esi\universe\SolarSystemRelation;
use yii\web\Controller;

class MapController extends Controller
{
    public function actionIndex()
    {
        $solarSystemsIds = EVE::universe()->solarSystems();
        $solarSystemsIds = array_filter($solarSystemsIds, function ($solarSystemId) {
            return $solarSystemId < 32000001;
        });
        //$solarSystemsIds = array_slice($solarSystemsIds, 0, 2500);

        /**
         * @var SolarSystem[] $solarSystems
         */
        $solarSystems = [];
        $x = $y = [];
        foreach ($solarSystemsIds as $solarSystemsId) {
            $solarSystem = EVE::universe()->solarSystem($solarSystemsId);
            if (!$solarSystem->isEmpireSpace()) {
                continue;
            }
            $solarSystems[] = $solarSystem;
            $x[] = $solarSystem->getX();
            $y[] = $solarSystem->getY();
        }

        $minX = min($x);
        $minY = min($y);
        $maxX = max($x);
        $maxY = max($y);

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

                $destinationSolarSystem = EVE::universe()->solarSystem($stargate->destination->systemId);
                $relations["{$solarSystem->systemId}:{$stargate->destination->systemId}"] = new SolarSystemRelation($solarSystem, $destinationSolarSystem);
            }
        }

        return $this->render('index', [
            'solarSystems' => $solarSystems,
            'relations' => $relations,
            'minX' => $minX,
            'minY' => $minY,
            'width' => $maxX - $minX,
            'height' => $maxY - $minY,
        ]);
    }
}
