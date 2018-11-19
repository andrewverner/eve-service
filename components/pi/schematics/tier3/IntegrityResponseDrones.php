<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:38
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class IntegrityResponseDrones extends Schematic
{
    const OUTPUT = [Material::TIER3_INTEGRITY_RESPONSE_DRONES => 1];

    const INPUT = [
        Material::TIER2_GEL_MATRIX_BIOPASTE => 6,
        Material::TIER2_HAZMAT_DETECTION_SYSTEMS => 6,
        Material::TIER2_PLANETARY_VEHICLES => 6,
    ];
}
