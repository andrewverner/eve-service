<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:10
 */

namespace app\components\pi\planets;

use app\components\pi\Material;
use app\components\pi\Planet;

class PlasmaPlanet extends Planet
{
    public $mask = 32;

    public $materials = [
        Material::RAW_MATERIAL_BASE_METALS,
        Material::RAW_MATERIAL_HEAVY_METALS,
        Material::RAW_MATERIAL_NOBLE_METALS,
        Material::RAW_MATERIAL_NON_CS_CRYSTALS,
        Material::RAW_MATERIAL_SUSPENDED_PLASMA,
    ];
}
