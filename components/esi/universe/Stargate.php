<?php

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;

class Stargate extends EVEObject
{
    /**
     * @var StargateDestination
     */
    public $destination;

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
    public $stargateId;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var int
     */
    public $typeId;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->destination = new StargateDestination($this->destination);
    }
}
