<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:37
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class NanoFactory extends Schematic
{
    const OUTPUT = [Material::TIER3_NANO_FACTORY => 1];

    const INPUT = [
        Material::TIER2_INDUSTRIAL_EXPLOSIVES => 6,
        Material::MATERIAL_REACTIVE_METALS => 40,
        Material::TIER2_UKOMI_SUPERCONDUCTORS => 6,
    ];
}
