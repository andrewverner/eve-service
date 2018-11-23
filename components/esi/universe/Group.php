<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 23.11.18
 * Time: 14:20
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class Group extends EVEObject
{
    /**
     * @var int
     */
    public $categoryId;

    /**
     * @var int
     */
    public $groupId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $published;

    /**
     * @var int[]
     */
    public $types;
}
