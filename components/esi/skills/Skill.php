<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 23.11.18
 * Time: 13:55
 */

namespace app\components\esi\skills;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Group;
use app\components\esi\universe\Type;

class Skill extends EVEObject
{
    /**
     * @var int
     */
    public $activeSkillLevel;

    /**
     * @var int
     */
    public $skillId;

    /**
     * @var int
     */
    public $skillpointsInSkill;

    /**
     * @var int
     */
    public $trainedSkillLevel;

    /**
     * @var Type
     */
    private $skill;

    /**
     * @var Group
     */
    private $group;

    /**
     * @return Type
     */
    public function skill()
    {
        if (!$this->skill) {
            $this->skill = EVE::universe()->type($this->skillId);
        }

        return $this->skill;
    }

    /**
     * @return Group|null
     */
    public function group()
    {
        if (!$this->group) {
            $this->group = EVE::universe()->group($this->skill()->groupId);
        }

        return $this->group;
    }
}
