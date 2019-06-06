<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 11:54
 */

namespace app\components\esi\character;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

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

    /**
     * @var Character
     */
    private $agent;

    /**
     * @var Type
     */
    private $skill;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->startedAt = new \DateTime($this->startedAt);
    }

    /**
     * @return Character
     * @throws \yii\web\NotFoundHttpException
     */
    public function getAgent()
    {
        if (!$this->agent) {
            $this->agent = EVE::character($this->agentId);
        }

        return $this->agent;
    }

    /**
     * @return Type
     */
    public function getSkill()
    {
        if (!$this->skill) {
            $this->skill = EVE::universe()->type($this->skillTypeId);
        }

        return $this->skill;
    }
}
