<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 13:47
 */

namespace app\components\esi\skills;

use app\components\esi\dogma\DogmaAttribute;
use app\components\esi\EVE;
use app\components\esi\universe\Type;
use yii\helpers\Html;

class SkillsExtractor
{
    public static function extract(Type $type)
    {
        $skillsList = [];

        /**
         * @var DogmaAttribute[] $skillsAttributes
         */
        $skillsAttributes = array_filter($type->dogmaAttributes(), function ($attribute) {
            /**
             * @var DogmaAttribute $attribute
             */
            return in_array($attribute->attributeId, [182, 183, 184, 1285, 1289, 1290]);
        });

        if (!$skillsAttributes) {
            return null;
        }

        /**
         * @var DogmaAttribute[] $levelsAttributes
         */
        $levelsAttributes = array_filter($type->dogmaAttributes(), function ($attribute) {
            /**
             * @var DogmaAttribute $attribute
             */
            return in_array($attribute->attributeId, [277, 278, 279, 1286, 1287, 1288]);
        });
        $skillLevelMap = [];
        foreach ($levelsAttributes as $levelsAttribute) {
            $skillLevelMap[$levelsAttribute->attributeId] = $levelsAttribute->value;
        }

        $skillLevelAttributeMap = array_combine(
            [182, 183, 184, 1285, 1289, 1290],
            [277, 278, 279, 1286, 1287, 1288]
        );
        foreach ($skillsAttributes as $skillsAttribute) {
            $skillModel = new RequiredSkill();
            $skillModel->typeId = $skillsAttribute->value;
            $skillModel->level = $skillLevelMap[$skillLevelAttributeMap[$skillsAttribute->attributeId]];
            $skill = EVE::universe()->type($skillModel->typeId);
            $skillModel->name = $skill->name;
            $skillModel->description = $skill->description;
            $skillModel->requiredSkills = self::extract($skill);
            $skillsList[] = $skillModel;
        }

        return $skillsList;
    }

    /**
     * @param RequiredSkill[] $list
     * @param callable|null $rowCallback
     * @return string
     */
    public static function buildList(array $list, callable $rowCallback = null)
    {
        $rows = [];
        foreach ($list as $skill) {
            $rows[] = call_user_func($rowCallback, $skill);
            if ($skill->requiredSkills) {
                $rows[] = self::buildList($skill->requiredSkills, $rowCallback);
            }
        }

        return Html::ul($rows, ['encode' => false]);
    }

    /**
     * @param RequiredSkill[] $list
     * @return array
     */
    public static function unique(array $list, array $data = [])
    {
        for ($i = 0; $i <= count($list) - 1; $i++) {
            $skill = $list[$i];
            if (!isset($data[$skill->typeId])) {
                $data[$skill->typeId] = $skill;
            } else {
                if ($skill->level > $data[$skill->typeId]->level) {
                    $data[$skill->typeId] = $skill;
                }
            }
            if ($skill->requiredSkills) {
                self::unique($skill->requiredSkills, $data);
            }
        }

        foreach ($data as &$skill) {
            $skill->requiredSkills = null;
        }

        return $data;
    }
}
