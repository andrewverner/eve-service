<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 15:28
 */

namespace app\components\esi\universe;

use app\components\esi\components\Request;
use app\components\esi\EVE;
use app\components\esi\SearchFactory;

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
        $request->cacheDuration = 3600 * 24 * 14;
        $station = $request->send(['station_id' => $stationId], $cacheKey);

        return new Station($station);
    }

    /**
     * @param $solarSystemId
     * @return SolarSystem
     */
    public function solarSystem($solarSystemId)
    {
        $cacheKey = "solarSystem:{$solarSystemId}";
        $request = EVE::request('/universe/systems/{system_id}/');
        $request->cacheDuration = 3600 * 24 * 14;
        $system = $request->send(['system_id' => $solarSystemId], $cacheKey);

        if (!$system) {
            return null;
        }

        return new SolarSystem($system);
    }

    /**
     * @param $start
     * @param $end
     * @param string $flag
     * @param array $avoid
     * @return Route
     */
    public function route($start, $end, $flag = Route::FLAG_SHORTEST, array $avoid = [])
    {
        $cacheKey = "route:{$start}:{$end}:{$flag}";
        if ($avoid) {
            $cacheKey .= ':' . md5(implode(':', $avoid));
        }
        $request = EVE::request('/route/{origin}/{destination}/');
        $request->cacheDuration = 3600 * 24 * 14;
        return new Route($request->send([
            'origin' => $start,
            'destination' => $end,
        ], $cacheKey));
    }

    /**
     * @param $typeId
     * @return Type
     */
    public function type($typeId)
    {
        $cacheKey = "type:{$typeId}";
        $request = EVE::request("/universe/types/{type_id}/");
        $request->cacheDuration = 3600 * 24 * 14;
        $type = $request->send(['type_id' => $typeId], $cacheKey);

        return new Type($type);
    }

    /**
     * @param int $page
     * @return int[]|bool
     */
    public function types($page = 1)
    {
        $request = EVE::request("/universe/types/");
        $request->query(['page' => $page]);
        return $request->send();
    }

    /**
     * @param array $names
     * @return IdsFactory
     */
    public function ids(array $names)
    {
        $cacheKey = "universe:ids:" . md5(implode($names));
        $request = EVE::request('/universe/ids/', null, Request::TYPE_POST);
        $request->cacheDuration = 3600 * 24 * 14;
        $request->body(json_encode($names));
        $data = $request->send(null, $cacheKey);

        return new IdsFactory($data);
    }

    /**
     * @param $query
     * @param array $categories
     * @param bool $strict
     * @return SearchFactory
     */
    public function search($query, array $categories, $strict = false)
    {
        $hash = md5(implode('', $categories));
        $cacheKey = "universe:search:{$hash}:{$query}";
        $request = EVE::request('/search/');
        $request->cacheDuration = 3600 * 24;
        $query = [
            'categories' => implode(',', $categories),
            'search' => $query,
            'strict' => $strict,
        ];
        $request->query($query);
        $data = $request->send(null, $cacheKey);

        return new SearchFactory($data);
    }

    /**
     * @return Faction[]|null
     */
    public function factions()
    {
        $cacheKey = "universe:factions";
        $request = EVE::request('/universe/factions/');
        $request->cacheDuration = 3600 * 7;
        $factions = $request->send(null, $cacheKey);

        if (!$factions) {
            return null;
        }

        foreach ($factions as &$faction) {
            $faction = new Faction($faction);
        }

        return $factions;
    }

    /**
     * @param  int $factionId
     * @return Faction|null
     */
    public function faction($factionId)
    {
        $factions = $this->factions();

        if (!$factions) {
            return null;
        }

        foreach ($factions as $faction) {
            if ($faction->factionId == $factionId) {
                return $faction;
            }
        }

        return null;
    }

    /**
     * @param int $id
     * @return Group|null
     */
    public function group($id)
    {
        $cacheKey = "universe:group:{$id}";
        $request = EVE::request('/universe/groups/{group_id}/');
        $request->cacheDuration = 3600 * 24 * 7;
        $data = $request->send(['group_id' => $id], $cacheKey);

        if (!$data) {
            return null;
        }

        return new Group($data);
    }
}
