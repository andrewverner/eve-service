<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:08
 */

namespace app\components\pi;

class StormPlanet extends Planet
{
    public $materials = [
        Material::RAW_MATERIAL_AQUEOUS_LIQUIDS,
        Material::RAW_MATERIAL_BASE_METALS,
        Material::RAW_MATERIAL_IONIC_SOLUTIONS,
        Material::RAW_MATERIAL_NOBLE_GAS,
        Material::RAW_MATERIAL_SUSPENDED_PLASMA,
    ];
}
