<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 14:35
 */

namespace app\components\esi\assets;

use app\components\esi\EVE;
use app\components\esi\universe\Type;

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

    /**
     * @var Type
     */
    public $type;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->type = EVE::universe()->type($this->typeId);
    }
}
