<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class PlanetColonyRoute extends EVEObject
{
    /**
     * @var int
     */
    public $contentTypeId;

    /**
     * @var int
     */
    public $destinationPinId;

    /**
     * @var float
     */
    public $quantity;

    /**
     * @var int
     */
    public $routeId;

    /**
     * @var int
     */
    public $sourcePinId;

    /**
     * @var int[]
     */
    public $waypoints;

    /**
     * @var Type
     */
    private $contentType;

    /**
     * @return Type
     */
    public function contentType()
    {
        if (!$this->contentType) {
            $this->contentType = EVE::universe()->type($this->contentTypeId);
        }

        return $this->contentType;
    }
}
