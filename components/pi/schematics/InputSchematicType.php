<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.2018
 * Time: 23:22
 */

namespace app\components\pi\schematics;

use app\components\esi\EVE;

class InputSchematicType
{
    public $type;

    public $quantity;

    public function __construct($id, $quantity)
    {
        $this->type = EVE::universe()->type($id);
        $this->quantity = $quantity;
    }
}
