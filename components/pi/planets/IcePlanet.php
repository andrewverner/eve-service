<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:05
 */

namespace app\components\pi\planets;

use app\components\pi\Material;
use app\components\pi\Planet;

class IcePlanet extends Planet
{
    public $mask = 4;

    public $materials = [
        Material::RAW_MATERIAL_AQUEOUS_LIQUIDS,
        Material::RAW_MATERIAL_HEAVY_METALS,
        Material::RAW_MATERIAL_MICROORGANISMS,
        Material::RAW_MATERIAL_NOBLE_GAS,
        Material::RAW_MATERIAL_PLANKTIC_COLONIES,
    ];
}