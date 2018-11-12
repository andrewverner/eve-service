<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 15:50
 */

namespace app\components\esi\location;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

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

    public function image($size)
    {
        return "http://image.eveonline.com/Render/{$this->shipTypeId}_{$size}.png";
    }

    /**
     * @return \app\components\esi\universe\Type
     */
    public function type()
    {
        return EVE::universe()->type($this->shipTypeId);
    }
}
