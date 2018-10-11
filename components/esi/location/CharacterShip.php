<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 15:50
 */

namespace app\components\esi\location;

use app\components\esi\components\EVEObject;

class CharacterShip extends EVEObject
{
    /**
     * @var int
     */
    public $shipItemId;

    /**
     * @var string
     */
    public $shipName;

    /**
     * @var int
     */
    public $shipTypeId;
}
