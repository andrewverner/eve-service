<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 12:33
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\dogma\DogmaAttribute;
use app\components\esi\dogma\DogmaEffect;
use app\components\esi\EVE;

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
     * @var DogmaAttribute[]
     */
    private $dogmaAttributesData;

    /**
     * @var DogmaEffect[]
     */
    private $dogmaEffectsData;

    /**
     * @var float
     */
    private $price;

    /**
     * @param int $size
     * @return string
     */
    public function image($size = 64)
    {
        return "http://image.eveonline.com/Type/{$this->typeId}_{$size}.png";
    }

    /**
     * @param int $size
     * @return string
     */
    public function render($size)
    {
        return "http://image.eveonline.com/Render/{$this->typeId}_{$size}.png";
    }

    /**
     * @return DogmaAttribute[]|array
     */
    public function dogmaAttributes()
    {
        if (!$this->dogmaAttributesData) {
            $this->dogmaAttributesData = $this->dogmaAttributes;
            foreach ($this->dogmaAttributesData as &$attribute) {
                $attribute = new DogmaAttribute($attribute);
            }
        }

        return $this->dogmaAttributesData;
    }

    /**
     * @return DogmaEffect[]|array
     */
    public function dogmaEffects()
    {
        if (!$this->dogmaEffectsData) {
            $this->dogmaEffectsData = $this->dogmaEffects;
            foreach ($this->dogmaEffectsData as &$effect) {
                $effect = new DogmaEffect($effect);
            }
        }

        return $this->dogmaEffectsData;
    }

    /**
     * @return float
     */
    public function price()
    {
        if (is_null($this->price)) {
            $this->price = EVE::market()->getPrice($this->typeId);
        }

        return $this->price;
    }
}
