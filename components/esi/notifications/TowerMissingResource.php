<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 15:48
 */

namespace app\components\esi\notifications;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class TowerMissingResource extends EVEObject
{
    /**
     * @var int
     */
    public $typeID;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var Type
     */
    private $type;

    /**
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeID);
        }

        return $this->type;
    }
}
