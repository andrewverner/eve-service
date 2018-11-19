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

class TranscranialMicrocontrollers extends Schematic
{
    const OUTPUT = [Material::TIER2_TRANSCRANIAL_MICROCONTROLLERS => 3];
    
    const INPUT = [
        Material::TIER1_BIOCELLS => 10,
        Material::TIER1_NANITES => 10,
    ];
}
