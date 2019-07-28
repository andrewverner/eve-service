<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class PlanetColonyExtractor extends EVEObject
{
    /**
     * @var int
     */
    public $cycleTime;

    /**
     * @var float
     */
    public $headRadius;

    /**
     * @var PlanetColonyExtractorHead[]
     */
    public $heads;

    /**
     * @var int
     */
    public $productTypeId;

    /**
     * @var int
     */
    public $qtyPerCycle;

    /**
     * @var Type
     */
    private $productType;

    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach ($this->heads as &$head) {
            $head = new PlanetColonyExtractorHead($head);
        }
    }

    /**
     * @return Type
     */
    public function productType()
    {
        if (!$this->productType) {
            $this->productType = EVE::universe()->type($this->productTypeId);
        }

        return $this->productType;
    }
}
