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

class SilicateGlass extends Schematic
{
    const OUTPUT = [Material::TIER1_SILICATE_GLASS => 5];
    
    const INPUT = [
        Material::MATERIAL_OXIDIZING_COMPOUND => 40,
        Material::MATERIAL_SILICON => 40,
    ];
}
