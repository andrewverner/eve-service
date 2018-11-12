<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 21:52
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class Station extends EVEObject
{
    /**
     * @var int
     */
    public $maxDockableShipVolume;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $officeRentalCost;

    /**
     * @var int
     */
    public $owner;

    /**
     * @var array
     */
    public $position;

    /**
     * @var int
     */
    public $raceId;

    /**
     * @var float
     */
    public $reprocessingEfficiency;

    /**
     * @var float
     */
    public $reprocessingStationsTake;

    /**
     * @var array
     */
    public $services;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @param $size int
     * @return string
     */
    public function image($size)
    {
        return "http://image.eveonline.com/Render/3867_{$size}.png";
    }

    /**
     * @return SolarSystem
     */
    public function getSolarSystem()
    {
        if (!$this->solarSystem) {
            $this->solarSystem = EVE::universe()->solarSystem($this->systemId);
        }

        return $this->solarSystem;
    }
}
