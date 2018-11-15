<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 12:22
 */

namespace app\components\esi\dogma;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class DogmaAttribute extends EVEObject
{
    /**
     * @var int
     */
    public $attributeId;

    /**
     * @var float
     */
    public $defaultValue;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $displayName;

    /**
     * @var bool
     */
    public $highIsGood;

    /**
     * @var int
     */
    public $iconId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var bool
     */
    public $published;

    /**
     * @var bool
     */
    public $stackable;

    /**
     * @var int
     */
    public $unitId;

    /**
     * @var mixed
     */
    public $value;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $cacheKey = "dogma:attribute:{$this->attributeId}";
        $request = EVE::request('/dogma/attributes/{attribute_id}/');
        $request->cacheDuration = 3600 * 12;
        $data = $request->send(['attribute_id' => $this->attributeId], $cacheKey);
        if ($data) {
            parent::__construct($data);
        }
    }
}
