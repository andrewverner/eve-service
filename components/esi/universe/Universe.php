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
use app\components\esi\industry\Facility;
use app\components\esi\SearchFactory;
use app\models\Token;
use yii\helpers\ArrayHelper;

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

        if (!$station) {
            return null;
        }

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
     * @param $structureId
     * @return Structure
     */
    public function structure($structureId)
    {
        $cacheKey = "structure:{$structureId}";
        $request = EVE::secureRequest('/universe/structures/{structure_id}/', Token::getSystemToken());
        $request->cacheDuration = 3600 * 24 * 7;
        $structure = $request->send(['structure_id' => $structureId], $cacheKey);

        if (!$structure) {
            return null;
        }

        return new Structure($structure);
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

    /**
     * @param array $ids
     * @return UniverseName[]|null
     */
    public function names(array $ids)
    {
        $request = EVE::request('/universe/names/', null, Request::TYPE_POST);
        $request->body(json_encode($ids));
        $names = $request->send();

        if (!$names) {
            return null;
        }

        foreach ($names as &$name) {
            $name = new UniverseName($name);
        }

        return $names;
    }

    /**
     * @param int $facilityId
     * @return Facility
     */
    public function facility($facilityId)
    {
        $facilityCacheKey = "facility:{$facilityId}";
        if (\Yii::$app->cache->exists($facilityCacheKey)) {
            $facility = unserialize(\Yii::$app->cache->get($facilityCacheKey));

            return new Facility($facility);
        }

        $listCacheKey = 'facilities';
        $request = EVE::request('/industry/facilities/');
        $facilitiesList = $request->send(null, $listCacheKey);
        $facilitiesList = ArrayHelper::index($facilitiesList, 'facility_id');
        $facility = $facilitiesList[$facilityId];
        \Yii::$app->cache->set($facilityCacheKey, serialize($facility), 3600 * 24);

        return new Facility($facility);
    }

    /**
     * @return int[]
     */
    public function structures()
    {
        $cacheKey = 'structures';
        $request = EVE::request('/universe/structures/');
        return $request->send(null, $cacheKey);
    }

    /**
     * @return int[]
     */
    public function solarSystems()
    {
        $cacheKey = 'systems';
        $request = EVE::request('/universe/systems/');
        $request->cacheDuration = 3600 * 24 * 14;
        return $request->send(null, $cacheKey);
    }

    /**
     * @param $stargateId
     * @return Stargate|null
     */
    public function stargate($stargateId)
    {
        $cacheKey = "stargate:{$stargateId}";
        $request = EVE::request('/universe/stargates/{stargate_id}/');
        $request->cacheDuration = 3600 * 24 * 7;
        $data = $request->send(['stargate_id' => $stargateId], $cacheKey);
        if (!$data) {
            return null;
        }

        return new Stargate($data);
    }

    /**
     * @return int[]
     */
    public function constellations()
    {
        $cacheKey = 'constellations';
        $request = EVE::request('/universe/constellations/');
        $request->cacheDuration = 2 * Request::DURATION_WEEK;
        return $request->send(null, $cacheKey);
    }

    /**
     * @param int $constellationId
     *
     * @return Constellation|null
     */
    public function constellation($constellationId)
    {
        $cacheKey = "constellation:{$constellationId}";
        $request = EVE::request('/universe/constellations/{constellation_id}/');
        $request->cacheDuration = 4 * Request::DURATION_WEEK;
        $constellation = $request->send(['constellation_id' => $constellationId], $cacheKey);
        if (!$constellation) {
            return null;
        }

        return new Constellation($constellation);
    }

    /**
     * @return int[]
     */
    public function regions()
    {
        $cacheKey = 'regions';
        $request = EVE::request('/universe/regions/');
        $request->cacheDuration = 2 * Request::DURATION_WEEK;
        return $request->send(null, $cacheKey);
    }

    /**
     * @param $regionId
     *
     * @return Region
     */
    public function region($regionId)
    {
        $cacheKey = "region:{$regionId}";
        $request = EVE::request('/universe/regions/{region_id}/');
        $request->cacheDuration = 4 * Request::DURATION_WEEK;
        $region = $request->send(['region_id' => $regionId], $cacheKey);
        if (!$region) {
            return null;
        }

        return new Region($region);
    }

    /**
     * @param $schematicId
     *
     * @return PlanetarySchematic|null
     */
    public function planetarySchematic($schematicId)
    {
        $cacheKey = "planetary:schematic:{$schematicId}";
        $request = EVE::request('/universe/schematics/{schematic_id}/');
        $request->cacheDuration = Request::DURATION_WEEK * 4;
        $schematic = $request->send(['schematic_id' => $schematicId], $cacheKey);

        if (!$schematic) {
            return null;
        }

        return new PlanetarySchematic($schematic);
    }
}
