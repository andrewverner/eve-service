<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.06.19
 * Time: 12:07
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class Region extends EVEObject
{
    /**
     * @var int[]
     */
    public $constellations;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $regionId;
}
