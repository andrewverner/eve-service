<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 13:15
 */

namespace app\components\pi\schematics;

use app\components\esi\EVE;
use app\components\esi\universe\Type;

class Input
{
    /**
     * @var int
     */
    private $typeId;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var Type
     */
    private $type;

    public function __construct($typeId, $quantity)
    {
        $this->typeId = $typeId;
        $this->quantity = $quantity;

        $this->type = EVE::universe()->type($typeId);
    }

    /**
     * @return Type
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }
}
