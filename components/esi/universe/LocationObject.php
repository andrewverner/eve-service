<?php

namespace app\components\esi\universe;

use app\components\esi\EVE;

class LocationObject
{
    /**
     * @var SolarSystem|Station|Structure|null
     */
    public $location;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @param int $locationId
     */
    public function __construct($locationId)
    {
        if (self::isSolarSystemId($locationId)) {
            $this->location = EVE::universe()->solarSystem($locationId);
            return;
        }
        if (in_array($locationId, EVE::universe()->structures())) {
            $this->location = EVE::universe()->structure($locationId);
            return;
        }
        if ($station = EVE::universe()->station($locationId)) {
            $this->location = $station;
            return;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (
            $this->location instanceof SolarSystem
            || $this->location instanceof Station
            || $this->location instanceof Structure
        ) {
            return $this->location->name;
        }

        return '';
    }

    public function getSolarSystem()
    {
        if (!$this->solarSystem) {
            $this->solarSystem = ($this->location instanceof SolarSystem)
                ? $this->location
                : $this->location->getSolarSystem();
        }

        return $this->solarSystem;
    }

    public static function isSolarSystemId($id)
    {
        return $id >= 30000001 && $id <= 33000050;
    }
}