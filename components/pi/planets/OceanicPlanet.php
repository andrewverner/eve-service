<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 12:07
 */

namespace app\components\pi\planets;

use app\components\pi\Material;
use app\components\pi\Planet;

class OceanicPlanet extends Planet
{
    public $mask = 16;

    public $materials = [
        Material::RAW_MATERIAL_AQUEOUS_LIQUIDS,
        Material::RAW_MATERIAL_CARBON_COMPOUNDS,
        Material::RAW_MATERIAL_COMPLEX_ORGANISMS,
        Material::RAW_MATERIAL_MICROORGANISMS,
        Material::RAW_MATERIAL_PLANKTIC_COLONIES,
    ];
}
