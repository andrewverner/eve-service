<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;

class PlanetColonyExtractorHead extends EVEObject
{
    /**
     * @var int
     */
    public $headId;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;
}
