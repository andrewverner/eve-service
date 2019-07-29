<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 29.07.19
 * Time: 15:03
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class PlanetarySchematic extends EVEObject
{
    /**
     * @var int
     */
    public $cycleTime;

    /**
     * @var string
     */
    public $schematicName;
}
