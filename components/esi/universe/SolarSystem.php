<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:16
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\helpers\EVEFormatter;
use app\components\pi\Planetary;
use yii\helpers\Html;

class SolarSystem extends EVEObject
{
    const COORDINATES_MULTIPLIER = 100000000000000;

    /**
     * @var int
     */
    public $constellationId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $planets;

    /**
     * @var array
     */
    public $position;

    /**
     * @var string
     */
    public $securityClass;

    /**
     * @var float
     */
    public $securityStatus;

    /**
     * @var int
     */
    public $starId;

    /**
     * @var array
     */
    public $stargates;

    /**
     * @var array
     */
    public $stations;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var Planet[]
     */
    public $planetsList;

    /**
     * @var Stargate[]
     */
    private $stargatesList = [];

    /**
     * @var float
     */
    private $dx;

    /**
     * @var float
     */
    private $dy;

    /**
     * @var float
     */
    private $dz;

    /**
     * @var Constellation;
     */
    private $constellation;

    const COLOR_NULL = '#ff0000';
    const COLOR_LOW = '#ff5e00';
    const COLOR_MEDIUM = '#efff00';
    const COLOR_ABOVE_MEDIUM = '#00ff37';
    const COLOR_HIGH = '#00ffe7';

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return Planet[]
     */
    public function planets()
    {
        if (!$this->planetsList) {
            foreach ($this->planets as $planet) {
                $this->planetsList[] = new Planet($planet);
            }
        }

        return $this->planetsList;
    }

    public function getFormattedSecurityStatus($withColor = false)
    {
        $ss = EVEFormatter::securityStatus($this->securityStatus);
        if (!$withColor) {
            return $ss;
        }

        switch ($ss) {
            case 1:
            case 0.9:
                $color = self::COLOR_HIGH;
                break;
            case 0.8:
            case 0.7:
                $color = self::COLOR_ABOVE_MEDIUM;
                break;
            case 0.6:
            case 0.5:
                $color = self::COLOR_MEDIUM;
                break;
            case 0.4:
            case 0.3:
            case 0.2:
                $color = self::COLOR_LOW;
                break;
            default:
                $color = self::COLOR_NULL;
        }

        return Html::tag('span', $ss, ['style' => "color:{$color}"]);
    }

    public function isEmpireSpace()
    {
        return $this->systemId < 31000001;
    }

    public function isWSpace()
    {
        return $this->systemId >= 31000001 && $this->systemId < 32000001;
    }

    public function isASpace()
    {
        return $this->systemId >= 32000001 && $this->systemId < 33000001;
    }

    public function isPSpace()
    {
        return $this->systemId >= 33000001;
    }

    public function getStargates()
    {
        if (!$this->stargates) {
            return [];
        }

        if (!$this->stargatesList) {
            foreach ($this->stargates as $stargateId) {
                $this->stargatesList[] = EVE::universe()->stargate($stargateId);
            }
        }

        return $this->stargatesList;
    }

    public function getX()
    {
        if (!$this->dx) {
            $this->dx = $this->position['x']/self::COORDINATES_MULTIPLIER;
        }

        return $this->dx;
    }

    public function getY($decart = false)
    {
        if (!$this->dy) {
            $this->dy = $this->position['z']/self::COORDINATES_MULTIPLIER;
        }

        return $decart ? $this->dy : (-1)*$this->dy;
    }

    public function getZ()
    {
        if (!$this->dz) {
            $this->dz = $this->position['y']/self::COORDINATES_MULTIPLIER;
        }

        return $this->dz;
    }

    public function getColor()
    {
        $ss = EVEFormatter::securityStatus($this->securityStatus);

        switch ($ss) {
            case 1:
            case 0.9:
                $color = self::COLOR_HIGH;
                break;
            case 0.8:
            case 0.7:
                $color = self::COLOR_ABOVE_MEDIUM;
                break;
            case 0.6:
            case 0.5:
                $color = self::COLOR_MEDIUM;
                break;
            case 0.4:
            case 0.3:
            case 0.2:
                $color = self::COLOR_LOW;
                break;
            default:
                $color = self::COLOR_NULL;
        }

        return $color;
    }

    /**
     * @return Constellation
     */
    public function constellation()
    {
        if (!$this->constellation) {
            $this->constellation = EVE::universe()->constellation($this->constellationId);
        }

        return $this->constellation;
    }
}
