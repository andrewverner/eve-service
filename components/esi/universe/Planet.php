<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.2018
 * Time: 21:47
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class Planet extends EVEObject
{
    /**
     * @var int
     */
    public $planetId;

    /**
     * @var int[]
     */
    public $asteroidBelts;

    /**
     * @var int[]
     */
    public $moons;

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
    public $typeId;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var Type
     */
    private $type;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $cacheKey = "planet:{$this->planetId}";
        $request = EVE::request('/universe/planets/{planet_id}/');
        $request->cacheDuration = 3600 * 24 * 14;
        $data = $request->send(['planet_id' => $this->planetId], $cacheKey);
        if ($data) {
            parent::__construct($data);
        }
    }

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
