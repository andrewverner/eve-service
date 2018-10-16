<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 12:22
 */

namespace app\components\esi\bookmarks;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class CharacterBookmarkItem extends EVEObject
{
    /**
     * @var int
     */
    public $itemId;

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
