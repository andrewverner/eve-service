<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class PlanetColonyPinContent extends EVEObject
{
    /**
     * @var int
     */
    public $amount;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var Type
     */
    private $type;

    /**
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeId);
        }

        return $this->type;
    }
}
