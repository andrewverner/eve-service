<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;

class PlanetColonyLink extends EVEObject
{
    /**
     * @var int
     */
    public $destinationPinId;

    /**
     * @var int
     */
    public $linkLevel;

    /**
     * @var int
     */
    public $sourcePinId;
}
