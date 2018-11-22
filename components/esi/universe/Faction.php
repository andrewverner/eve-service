<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.11.18
 * Time: 16:51
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;

class Faction extends EVEObject
{
    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var bool
     */
    public $isUnique;

    /**
     * @var int
     */
    public $militiaCorporationId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $sizeFactor;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $stationCount;

    /**
     * @var int
     */
    public $stationSystemCount;

    /**
     * @var Corporation
     */
    private $corporation;

    /**
     * @var Corporation
     */
    private $militiaCorporation;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @return Corporation
     */
    public function corporation()
    {
        if (!$this->corporation && $this->corporationId) {
            $this->corporation = EVE::corporation($this->corporationId);
        }

        return $this->corporation;
    }

    /**
     * @return Corporation
     */
    public function militiaCorporation()
    {
        if (!$this->militiaCorporation && $this->militiaCorporationId) {
            $this->militiaCorporation = EVE::corporation($this->militiaCorporationId);
        }

        return $this->militiaCorporation;
    }

    /**
     * @return SolarSystem
     */
    public function solarSystem()
    {
        if (!$this->solarSystem && $this->solarSystemId) {
            $this->solarSystem = EVE::universe()->solarSystem($this->solarSystemId);
        }

        return $this->solarSystem;
    }

    /**
     * @param int $size
     * @return string
     */
    public function image($size)
    {
        return "http://image.eveonline.com/Alliance/{$this->factionId}_{$size}.png";
    }
}
