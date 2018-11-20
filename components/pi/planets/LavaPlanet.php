<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:01
 */

namespace app\components\pi\planets;

use app\components\pi\Material;
use app\components\pi\Planet;

class LavaPlanet extends Planet
{
    public $materials = [
        Material::RAW_MATERIAL_BASE_METALS,
        Material::RAW_MATERIAL_FELSIC_MAGMA,
        Material::RAW_MATERIAL_HEAVY_METALS,
        Material::RAW_MATERIAL_NON_CS_CRYSTALS,
        Material::RAW_MATERIAL_SUSPENDED_PLASMA,
    ];
}
