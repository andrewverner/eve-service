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

class Superconductors extends Schematic
{
    const OUTPUT = [Material::TIER1_SUPERCONDUCTORS => 5];
    
    const INPUT = [
        Material::MATERIAL_PLASMOIDS => 40,
        Material::MATERIAL_WATER => 40,
    ];
}
