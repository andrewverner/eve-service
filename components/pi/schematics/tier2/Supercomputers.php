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

class Supercomputers extends Schematic
{
    const OUTPUT = [Material::TIER2_SUPERCOMPUTERS => 3];
    
    const INPUT = [
        Material::TIER1_WATER_COOLED_CPU => 10,
        Material::TIER1_COOLANT => 10,
        Material::TIER1_CONSUMER_ELECTRONICS => 10,
    ];
}
