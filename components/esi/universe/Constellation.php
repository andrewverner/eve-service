<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.06.19
 * Time: 11:57
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class Constellation extends EVEObject
{
    /**
     * @var int
     */
    public $constellationId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $position;

    /**
     * @var int
     */
    public $regionId;

    /**
     * @var int[]
     */
    public $systems;

    /**
     * @var Region
     */
    private $region;

    /**
     * @return Region
     */
    public function getRegion()
    {
        if (!$this->region) {
            $this->region = EVE::universe()->region($this->regionId);
        }

        return $this->region;
    }
}
