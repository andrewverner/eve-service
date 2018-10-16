<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 11:54
 */

namespace app\components\esi\character;

use app\components\esi\components\EVEObject;

class CharacterAgentResearch extends EVEObject
{
    /**
     * @var int
     */
    public $agentId;

    /**
     * @var float
     */
    public $pointsPerDay;

    /**
     * @var float
     */
    public $remainderPoints;

    /**
     * @var int
     */
    public $skillTypeId;

    /**
     * @var \DateTime
     */
    public $startedAt;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->startedAt = new \DateTime($this->startedAt);
    }
}
