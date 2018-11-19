<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:36
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class OrganicMortarApplicators extends Schematic
{
    const OUTPUT = [Material::TIER3_ORGANIC_MORTAR_APPLICATORS => 1];

    const INPUT = [
        Material::TIER2_CONDENSATES => 6,
        Material::MATERIAL_BACTERIA => 40,
        Material::TIER2_ROBOTICS => 6,
    ];
}
