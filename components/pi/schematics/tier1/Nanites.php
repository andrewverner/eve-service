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

class Nanites extends Schematic
{
    const OUTPUT = [Material::TIER1_NANITES => 5];
    
    const INPUT = [
        Material::MATERIAL_BACTERIA => 40,
        Material::MATERIAL_REACTIVE_METALS => 40,
    ];
}
