<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 12:33
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class Type extends EVEObject
{
    /**
     * @var float
     */
    public $capacity;

    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $dogmaAttributes;

    /**
     * @var array
     */
    public $dogmaEffects;

    /**
     * @var int
     */
    public $graphicId;

    /**
     * @var int
     */
    public $groupId;

    /**
     * @var int
     */
    public $iconId;

    /**
     * @var int
     */
    public $marketGroupId;

    /**
     * @var float
     */
    public $mass;

    /**
     * @var string
     */
    public $name;

    /**
     * @var float
     */
    public $packagedVolume;

    /**
     * @var int
     */
    public $portionSize;

    /**
     * @var bool
     */
    public $published;

    /**
     * @var float
     */
    public $radius;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var float
     */
    public $volume;

    /**
     * @param $size int
     * @return string
     */
    public function image($size)
    {
        return "http://image.eveonline.com/Render/{$this->typeId}_{$size}.png";
    }
}
