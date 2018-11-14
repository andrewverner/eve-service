<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.11.18
 * Time: 8:50
 */

namespace app\components\esi\killmails;

use app\components\esi\components\EVEObject;

class KillMailVictimItem extends EVEObject
{
    /**
     * @var int
     */
    public $flag;

    /**
     * @var int
     */
    public $itemTypeId;

    /**
     * @var int
     */
    public $quantityDestroyed;

    /**
     * @var int
     */
    public $quantityDropped;

    /**
     * @var int
     */
    public $singleton;
}
