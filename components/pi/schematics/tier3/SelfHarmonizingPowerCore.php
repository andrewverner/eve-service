<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:11
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class SelfHarmonizingPowerCore extends Schematic
{
    const OUTPUT = [Material::TIER3_SELF_HARMONIZING_POWER_CORE => 1];

    const INPUT = [
        Material::TIER2_CAMERA_DRONES => 6,
        Material::TIER2_NUCLEAR_REACTORS => 6,
        Material::TIER2_HERMETIC_MEMBRANES => 6,
    ];
}
