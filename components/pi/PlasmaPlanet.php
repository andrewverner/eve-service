<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:10
 */

namespace app\components\pi;

class PlasmaPlanet extends Planet
{
    public $materials = [
        Material::RAW_MATERIAL_BASE_METALS,
        Material::RAW_MATERIAL_HEAVY_METALS,
        Material::RAW_MATERIAL_NOBLE_METALS,
        Material::RAW_MATERIAL_NON_CS_CRYSTALS,
        Material::RAW_MATERIAL_SUSPENDED_PLASMA,
    ];
}
