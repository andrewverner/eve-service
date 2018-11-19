<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\base;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class Proteins extends Schematic
{
    const OUTPUT = [Material::MATERIAL_PROTEINS => 40];
    
    const INPUT = [
        Material::RAW_MATERIAL_COMPLEX_ORGANISMS => 3000,
    ];
}
