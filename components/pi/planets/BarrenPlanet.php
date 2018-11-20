<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:48
 */

namespace app\components\pi\planets;

use app\components\pi\Material;
use app\components\pi\Planet;

class BarrenPlanet extends Planet
{
    public $materials = [
        Material::RAW_MATERIAL_AQUEOUS_LIQUIDS,
        Material::RAW_MATERIAL_BASE_METALS,
        Material::RAW_MATERIAL_CARBON_COMPOUNDS,
        Material::RAW_MATERIAL_MICROORGANISMS,
        Material::RAW_MATERIAL_NOBLE_METALS,
    ];
}