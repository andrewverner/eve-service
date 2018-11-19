<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 13:11
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class WetwareMainframe extends Schematic
{
    const OUTPUT = [Material::TIER3_WETWARE_MAINFRAME => 1];

    const INPUT = [
        Material::TIER2_SUPERCOMPUTERS => 6,
        Material::TIER2_BIOTECH_RESEARCH_REPORTS => 6,
        Material::TIER2_CRYOPROTECTANT_SOLUTION => 6,
    ];
}
