<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.10.18
 * Time: 15:55
 */

namespace app\commands;

use app\components\esi\EVE;
use app\components\esi\helpers\EVEFormatter;
use yii\helpers\Console;

class EveCacheController extends ConsoleController
{
    public function actionTypes()
    {
        $page = 1;
        while ($types = EVE::universe()->types($page)) {
            $this->logInfo(sprintf('Page %d. %d types were fetched. Processing...', $page, count($types)));
            foreach ($types as $type) {
                $item = EVE::universe()->type($type);
                $this->logInfo(sprintf('%d: %s has been cached', $item->typeId, $item->name));
            }
            $page++;
        }

        $this->logSuccess('Done');
    }

    public function actionSolarSystems()
    {
        $solarSystems = EVE::universe()->solarSystems();
        if (!$solarSystems) {
            $this->logWarning('Solar systems list is empty...');
            return;
        }

        $this->logInfo(sprintf('%d solar systems were fetched. Processing', count($solarSystems)));

        foreach ($solarSystems as $solarSystemId) {
            if (\Yii::$app->cache->exists("solarSystem:{$solarSystemId}")) {
                $this->logInfo(sprintf('%d: solar system is already cached. Skipping...', $solarSystemId));
                continue;
            }

            try {
                $solarSystem = EVE::universe()->solarSystem($solarSystemId);
                $message = sprintf('%d: %s (%1.1f) solar system has been cached', $solarSystemId, $solarSystem->name, $solarSystem->securityStatus);
                $ss = EVEFormatter::securityStatus($solarSystem->securityStatus);
                switch ($ss) {
                    case 1:
                    case 0.9:
                        $color = Console::FG_BLUE;
                        break;
                    case 0.8:
                    case 0.7:
                        $color = Console::FG_GREEN;
                        break;
                    case 0.6:
                    case 0.5:
                    case 0.4:
                        $color = Console::FG_YELLOW;
                        break;
                    default:
                        $color = Console::FG_RED;
                }
                $this->stdout($message . PHP_EOL, $color);

                if ($solarSystem->stargates) {
                    foreach ($solarSystem->stargates as $stargateId) {
                        if (\Yii::$app->cache->exists("stargate:{$stargateId}")) {
                            continue;
                        }

                        EVE::universe()->stargate($stargateId);
                        $this->logInfo(sprintf('Stargate %d has been cached', $stargateId));
                    }
                }
            } catch (\Exception $exception) {
                $this->logError(sprintf('An error occurred while caching system %d', $solarSystemId));
                continue;
            }
        }

        $this->logSuccess('Done');
    }

    public function actionStarGates()
    {

    }
}
