<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 13:30
 */

namespace app\components\esi\skills;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class QueuedSkill extends EVEObject
{
    /**
     * @var \DateTime
     */
    public $finishDate;

    /**
     * @var int
     */
    public $finishedLevel;

    /**
     * @var int
     */
    public $levelEndSp;

    /**
     * @var int
     */
    public $levelStartSp;

    /**
     * @var int
     */
    public $queuePosition;

    /**
     * @var int
     */
    public $skillId;

    /**
     * @var \DateTime
     */
    public $startDate;

    /**
     * @var int
     */
    public $trainingStartSp;

    private $type;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->finishDate = new \DateTime($this->finishDate);
        $this->startDate = new \DateTime($this->startDate);
    }

    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->skillId);
        }

        return $this->type;
    }
}
