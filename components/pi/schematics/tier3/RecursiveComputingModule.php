<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:34
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class RecursiveComputingModule extends Schematic
{
    const OUTPUT = [Material::TIER3_RECURSIVE_COMPUTING_MODULE => 1];

    const INPUT = [
        Material::TIER2_SYNTHETIC_SYNAPSES => 6,
        Material::TIER2_GUIDANCE_SYSTEMS => 6,
        Material::TIER2_TRANSCRANIAL_MICROCONTROLLERS => 6,
    ];
}
