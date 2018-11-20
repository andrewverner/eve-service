<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.2018
 * Time: 22:32
 */

namespace app\components\esi;

use app\components\esi\components\EVEObject;
use app\components\esi\universe\SolarSystem;
use app\components\esi\universe\Type;

class SearchFactory extends EVEObject
{
    const CATEGORY_AGENT = 'agent';
    const CATEGORY_ALLIANCE = 'alliance';
    const CATEGORY_CHARACTER = 'character';
    const CATEGORY_CONSTELLATION = 'constellation';
    const CATEGORY_CORPORATION = 'corporation';
    const CATEGORY_FACTION = 'faction';
    const CATEGORY_INVENTORY_TYPE = 'inventory_type';
    const CATEGORY_REGION = 'region';
    const CATEGORY_SOLAR_SYSTEM = 'solar_system';
    const CATEGORY_STATION = 'station';

    public $agent;
    public $alliance;
    public $character;
    public $constellation;
    public $corporation;
    public $faction;

    /**
     * @var Type[]
     */
    public $inventoryType;
    public $region;
    public $station;

    /**
     * @var SolarSystem[]
     */
    public $solarSystem;

    public function __construct(array $data)
    {
        parent::__construct($data);
        if ($this->solarSystem) {
            foreach ($this->solarSystem as &$system) {
                $system = EVE::universe()->solarSystem($system);
            }
        }
    }
}
