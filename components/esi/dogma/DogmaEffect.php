<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 12:51
 */

namespace app\components\esi\dogma;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class DogmaEffect extends EVEObject
{
    /**
     * @var string
     */
    public $description;

    /**
     * @var bool
     */
    public $disallowAutoRepeat;

    /**
     * @var int
     */
    public $dischargeAttributeId;

    /**
     * @var string
     */
    public $displayName;

    /**
     * @var int
     */
    public $durationAttributeId;

    /**
     * @var int
     */
    public $effectCategory;

    /**
     * @var int
     */
    public $effectId;

    /**
     * @var bool
     */
    public $electronicChance;

    /**
     * @var int
     */
    public $falloffAttributeId;

    /**
     * @var int
     */
    public $iconId;

    /**
     * @var bool
     */
    public $isAssistance;

    /**
     * @var bool
     */
    public $isOffensive;

    /**
     * @var bool
     */
    public $isWarpSafe;

    /**
     * @var array
     */
    public $modifiers;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $postExpression;

    /**
     * @var int
     */
    public $preExpression;

    /**
     * @var bool
     */
    public $published;

    /**
     * @var int
     */
    public $rangeAttributeId;

    /**
     * @var bool
     */
    public $rangeChance;

    /**
     * @var int
     */
    public $trackingSpeedAttributeId;

    /**
     * @var bool
     */
    public $isDefault;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $cacheKey = "dogma:effect:{$this->effectId}";
        $request = EVE::request('/dogma/effects/{effect_id}/');
        $request->cacheDuration = 3600 * 12;
        $data = $request->send(['effect_id' => $this->effectId], $cacheKey);
        if ($data) {
            parent::__construct($data);
        }
    }
}
