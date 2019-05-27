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
    const PRIMARY_SKILL_DOGMA_ATTRIBUTE_ID = 182;
    const SECONDARY_SKILL_DOGMA_ATTRIBUTE_ID = 183;
    const TERTIARY_SKILL_DOGMA_ATTRIBUTE_ID = 184;
    const QUATERNARY_SKILL_DOGMA_ATTRIBUTE_ID = 1285;
    const QUINARY_SKILL_DOGMA_ATTRIBUTE_ID = 1289;
    const SENARY_SKILL_DOGMA_ATTRIBUTE_ID = 1290;
    const SKILLS_DOGMA_ATTRIBUTES = [
        self::PRIMARY_SKILL_DOGMA_ATTRIBUTE_ID,
        self::SECONDARY_SKILL_DOGMA_ATTRIBUTE_ID,
        self::TERTIARY_SKILL_DOGMA_ATTRIBUTE_ID,
        self::QUATERNARY_SKILL_DOGMA_ATTRIBUTE_ID,
        self::QUINARY_SKILL_DOGMA_ATTRIBUTE_ID,
        self::SENARY_SKILL_DOGMA_ATTRIBUTE_ID,
    ];

    const SKILL1_REQUIRED_DOGMA_ATTRIBUTE_ID = 277;
    const SKILL2_REQUIRED_DOGMA_ATTRIBUTE_ID = 278;
    const SKILL3_REQUIRED_DOGMA_ATTRIBUTE_ID = 279;
    const SKILL4_REQUIRED_DOGMA_ATTRIBUTE_ID = 1286;
    const SKILL5_REQUIRED_DOGMA_ATTRIBUTE_ID = 1287;
    const SKILL6_REQUIRED_DOGMA_ATTRIBUTE_ID = 1288;
    const SKILL_REQUIRED_DOGMA_ATTRIBUTES = [
        self::SKILL1_REQUIRED_DOGMA_ATTRIBUTE_ID,
        self::SKILL2_REQUIRED_DOGMA_ATTRIBUTE_ID,
        self::SKILL3_REQUIRED_DOGMA_ATTRIBUTE_ID,
        self::SKILL4_REQUIRED_DOGMA_ATTRIBUTE_ID,
        self::SKILL5_REQUIRED_DOGMA_ATTRIBUTE_ID,
        self::SKILL6_REQUIRED_DOGMA_ATTRIBUTE_ID,
    ];

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
            return in_array($attribute->attributeId, self::SKILLS_DOGMA_ATTRIBUTES);
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
            return in_array($attribute->attributeId, self::SKILL_REQUIRED_DOGMA_ATTRIBUTES);
        });
        $skillLevelMap = [];
        foreach ($levelsAttributes as $levelsAttribute) {
            $skillLevelMap[$levelsAttribute->attributeId] = $levelsAttribute->value;
        }

        $skillLevelAttributeMap = array_combine(
            self::SKILLS_DOGMA_ATTRIBUTES,
            self::SKILL_REQUIRED_DOGMA_ATTRIBUTES
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
