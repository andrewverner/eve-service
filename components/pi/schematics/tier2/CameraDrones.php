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

class CameraDrones extends Schematic
{
    const OUTPUT = [Material::TIER2_CAMERA_DRONES => 3];
    
    const INPUT = [
        Material::TIER1_SILICATE_GLASS => 10,
        Material::TIER1_ROCKET_FUEL => 10,
    ];
}
