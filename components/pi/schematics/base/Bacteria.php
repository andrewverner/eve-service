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

class Bacteria extends Schematic
{
    const OUTPUT = [Material::MATERIAL_BACTERIA => 40];
    
    const INPUT = [
        Material::RAW_MATERIAL_MICROORGANISMS => 3000,
    ];
}
