<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:16
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class SolarSystem extends EVEObject
{
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
}
