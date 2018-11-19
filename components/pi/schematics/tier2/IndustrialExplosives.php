<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\tier2;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class IndustrialExplosives extends Schematic
{
    const OUTPUT = [Material::TIER2_INDUSTRIAL_EXPLOSIVES => 3];
    
    const INPUT = [
        Material::TIER1_FERTILIZER => 10,
        Material::TIER1_POLYTEXTILES => 10,
    ];
}
