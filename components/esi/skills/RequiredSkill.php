<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 13:53
 */

namespace app\components\esi\skills;

class RequiredSkill
{
    /**
     * @var int
     */
    public $typeId;

    /**
     * @var int
     */
    public $level;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var array
     */
    public $requiredSkills;
}
