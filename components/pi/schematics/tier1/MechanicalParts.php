<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\tier1;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class MechanicalParts extends Schematic
{
    const OUTPUT = [Material::TIER1_MECHANICAL_PARTS => 5];
    
    const INPUT = [
        Material::MATERIAL_REACTIVE_METALS => 40,
        Material::MATERIAL_PRECIOUS_METALS => 40,
    ];
}
