<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 23.11.18
 * Time: 13:58
 */

namespace app\components\esi\skills;

use app\components\esi\components\EVEObject;

class CharacterSkills extends EVEObject
{
    /**
     * @var array
     */
    public $skills;

    /**
     * @var array
     */
    private $skillsList;

    /**
     * @var int
     */
    public $totalSp;

    /**
     * @var int
     */
    public $unallocatedSp;

    /**
     * @return Skill[]|array
     */
    public function skills()
    {
        if (!$this->skillsList) {
            foreach ($this->skills as $skillData) {
                $skill = new Skill($skillData);
                $this->skillsList[$skill->group()->name][] = $skill;
            }
        }
        ksort($this->skillsList);
        foreach ($this->skillsList as &$list) {
            usort($list, function ($first, $second) {
                /**
                 * @var Skill $first
                 * @var Skill $second
                 */

                return $first->skill()->name <=> $second->skill()->name;
            });
        }

        return $this->skillsList;
    }
}
