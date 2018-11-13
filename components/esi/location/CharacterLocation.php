<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:25
 */

namespace app\components\esi\location;

use \app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;

class CharacterLocation extends EVEObject
{
    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var int
     */
    public $structureId;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @return \app\components\esi\universe\SolarSystem|bool
     */
    public function solarSystem()
    {
        if (!$this->solarSystemId) {
            return false;
        }

        if (!$this->solarSystem) {
            $this->solarSystem = EVE::universe()->solarSystem($this->solarSystemId);
        }

        return $this->solarSystem;
    }

    /**
     * @return \app\components\esi\universe\Station|bool
     */
    public function station()
    {
        if (!$this->stationId) {
            return false;
        }

        return EVE::universe()->station($this->stationId);
    }
}
