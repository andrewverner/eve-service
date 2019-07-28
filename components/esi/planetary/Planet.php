<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;
use DateTime;

class Planet extends EVEObject
{
    /**
     * @var DateTime
     */
    public $lastUpdate;

    /**
     * @var int
     */
    public $numPins;

    /**
     * @var int
     */
    public $ownerId;

    /**
     * @var int
     */
    public $planetId;

    /**
     * @var string
     */
    public $planetType;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $upgradeLevel;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @var \app\components\esi\universe\Planet;
     */
    private $planet;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if ($this->lastUpdate) {
            $this->lastUpdate = new DateTime($this->lastUpdate);
        }
    }

    /**
     * @return SolarSystem
     */
    public function solarSystem()
    {
        if (!$this->solarSystem) {
            $this->solarSystem = EVE::universe()->solarSystem($this->solarSystemId);
        }

        return $this->solarSystem;
    }

    /**
     * @return \app\components\esi\universe\Planet
     */
    public function planet()
    {
        if (!$this->planet) {
            $this->planet = new \app\components\esi\universe\Planet(['planet_id' => $this->planetId]);
        }

        return $this->planet;
    }

    /**
     * @return string
     */
    public function image()
    {
        return "http://www.eveplanets.com/m/eve/img/planet_{$this->planetType}.jpg";
    }
}
