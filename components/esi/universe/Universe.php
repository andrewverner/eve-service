<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 15:28
 */

namespace app\components\esi\universe;

use app\components\esi\EVE;

class Universe
{
    /**
     * @param $stationId
     * @return Station
     */
    public function station($stationId)
    {
        $cacheKey = "station:{$stationId}";
        $request = EVE::request('/universe/stations/{station_id}/');
        $request->cacheDuration = 3600 * 24;
        $station = $request->send(['station_id' => $stationId], $cacheKey);

        return new Station($station);
    }

    public function solarSystem($solarSystemId)
    {
        $cacheKey = "solarSystem:{$solarSystemId}";
        $request = EVE::request('/universe/systems/{system_id}/');
        $request->cacheDuration = 3600 * 24;
        $system = $request->send(['system_id' => $solarSystemId], $cacheKey);

        return new SolarSystem($system);
    }

    public function route($start, $end)
    {
        $request = EVE::request('/route/{origin}/{destination}/');
        return $request->send([
            'origin' => $start,
            'destination' => $end,
        ]);
    }
}
