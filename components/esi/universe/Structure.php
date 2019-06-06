<?php

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class Structure extends EVEObject
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $ownerId;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @return SolarSystem
     */
    public function getSolarSystem()
    {
        if (!$this->solarSystem) {
            $this->solarSystem = EVE::universe()->solarSystem($this->solarSystemId);
        }

        return $this->solarSystem;
    }
}