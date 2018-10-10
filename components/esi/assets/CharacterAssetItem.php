<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 14:35
 */

namespace app\components\esi\assets;

class CharacterAssetItem extends AssetItem
{
    /**
     * @var bool
     */
    public $isBlueprintCopy;

    /**
     * @var bool
     */
    public $isSingleton;

    /**
     * @var int
     */
    public $itemId;

    /**
     * @var string
     */
    public $locationFlag;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var string
     */
    public $locationType;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $typeId;
}
