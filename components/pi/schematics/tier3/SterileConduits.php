<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:08
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class SterileConduits extends Schematic
{
    const OUTPUT = [Material::TIER3_STERILE_CONDUITS => 1];

    const INPUT = [
        Material::TIER2_SMARTFAB_UNITS => 6,
        Material::MATERIAL_WATER => 40,
        Material::TIER2_VACCINES => 6,
    ];
}
