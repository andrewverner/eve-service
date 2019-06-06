<?php

namespace app\components\esi\industry;

use app\components\esi\components\EVEObject;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;
use app\components\esi\universe\Type;
use yii\web\BadRequestHttpException;

class Facility extends EVEObject
{
    /**
     * ID of the facility
     *
     * @var int
     */
    public $facilityId;

    /**
     * Owner of the facility
     *
     * @var int
     */
    public $ownerId;

    /**
     * Region ID where the facility is
     *
     * @var int
     */
    public $regionId;

    /**
     * Solar system ID where the facility is
     *
     * @var int
     */
    public $solarSystemId;

    /**
     * Tax imposed by the facility
     *
     * @var float
     * @optional
     */
    public $tax;

    /**
     * Type ID of the facility
     *
     * @var int
     */
    public $typeId;

    /**
     * @var Corporation;
     */
    private $owner;

    /**
     * @todo implemete
     */
    private $region;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @var Type
     */
    private $type;

    /**
     * @return Corporation
     */
    public function getOwner()
    {
        if (!$this->owner) {
            $this->owner = EVE::corporation($this->ownerId);
        }

        return $this->owner;
    }

    public function getRegion()
    {
        throw new BadRequestHttpException('getRegion method not implemented');
    }

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

    /**
     * @return Type
     */
    public function getType()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeId);
        }

        return $this->type;
    }
}
