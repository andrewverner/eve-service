<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:09
 */

namespace app\components\pi;

class TemperatePlanet extends Planet
{
    public $materials = [
        Material::RAW_MATERIAL_AQUEOUS_LIQUIDS,
        Material::RAW_MATERIAL_AUTOTROPHS,
        Material::RAW_MATERIAL_CARBON_COMPOUNDS,
        Material::RAW_MATERIAL_COMPLEX_ORGANISMS,
        Material::RAW_MATERIAL_MICROORGANISMS,
    ];
}
