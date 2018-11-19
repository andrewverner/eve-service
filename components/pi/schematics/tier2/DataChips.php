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

class DataChips extends Schematic
{
    const OUTPUT = [Material::TIER2_DATA_CHIPS => 3];
    
    const INPUT = [
        Material::TIER1_SUPERTENSILE_PLASTICS => 10,
    Material::TIER1_MICROFIBER_SHIELDING => 10,
    ];
}
