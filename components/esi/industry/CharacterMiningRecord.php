<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 30.11.18
 * Time: 8:25
 */

namespace app\components\esi\industry;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;
use app\components\esi\universe\Type;

class CharacterMiningRecord extends EVEObject
{
    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var SolarSystem
     */
    public $solarSystem;

    /**
     * @var Type
     */
    public $type;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
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
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeId);
        }

        return $this->type;
    }
}
