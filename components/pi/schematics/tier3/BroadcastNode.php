<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\tier3;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class BroadcastNode extends Schematic
{
    const OUTPUT = [Material::TIER3_BROADCAST_NODE => 1];

    const INPUT = [
        Material::TIER2_NEOCOMS => 6,
        Material::TIER2_DATA_CHIPS => 6,
        Material::TIER2_HIGH_TECH_TRANSMITTERS => 6,
    ];
}
