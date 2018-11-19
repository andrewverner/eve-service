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

class Biofuels extends Schematic
{
    const OUTPUT = [Material::MATERIAL_BIOFUELS => 40];
    
    const INPUT = [
        Material::RAW_MATERIAL_CARBON_COMPOUNDS => 3000,
    ];
}
