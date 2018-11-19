<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\components\esi\skills\SkillsExtractor;
use app\components\pi\BarrenPlanet;
use app\components\pi\GasPlanet;
use app\components\pi\IcePlanet;
use app\components\pi\LavaPlanet;
use app\components\pi\Material;
use app\components\pi\OceanicPlanet;
use app\components\pi\Planetary;
use app\components\pi\schematics\tier3\WetwareMainframe;
use app\components\pi\StormPlanet;
use app\components\pi\TemperatePlanet;
use app\models\CharacterRoute;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionRouteHash()
    {
        $models = CharacterRoute::find()->all();
        foreach ($models as $model) {
            $model->hash = substr(md5($model->character_id . time() . uniqid() . md5($model->route)) . md5($model->route . time()), 0, 64);
            if ($model->validate()) {
                $model->save();
            }
        }
    }

    public function actionMarket()
    {
        EVE::market()->prices();
    }

    public function actionSkillExtractor()
    {
        $titan = EVE::universe()->type(24314);
        /*echo '<pre>';
        print_r(SkillsExtractor::extract($titan));
        echo '</pre>';*/
        /*$callback = function () {
            $skill = func_get_arg(0);
            return "<div>
    <div class=\"skill-title float-left text-left\">
        {$skill->name}
    </div>
    <div class=\"skill-level float-right text-right\">
        {$skill->level}
    </div>
</div>";
        };*/
        $skills = SkillsExtractor::extract($titan);
        //echo SkillsExtractor::buildList($skills, $callback);
        echo '<pre>';
        print_r(SkillsExtractor::unique($skills));
        echo '</pre>';
    }

    public function actionPi()
    {
        echo '<pre>';
        $tier2 = [
            Material::TIER2_BIOTECH_RESEARCH_REPORTS => [
                Material::TIER1_NANITES,
                Material::TIER1_LIVESTOCK,
                Material::TIER1_CONSTRUCTION_BLOCKS,
            ],
            Material::TIER2_CAMERA_DRONES => [
                Material::TIER1_SILICATE_GLASS,
                Material::TIER1_ROCKET_FUEL,
            ],
            Material::TIER2_CONDENSATES => [
                Material::TIER1_OXIDES,
                Material::TIER1_COOLANT,
            ],
            Material::TIER2_CRYOPROTECTANT_SOLUTION => [
                Material::TIER1_TEST_CULTURES,
                Material::TIER1_SYNTHETIC_OIL,
                Material::TIER1_FERTILIZER,
            ],
            Material::TIER2_DATA_CHIPS => [
                Material::TIER1_SUPERTENSILE_PLASTICS,
                Material::TIER1_MICROFIBER_SHIELDING,
            ],
            Material::TIER2_GEL_MATRIX_BIOPASTE => [
                Material::TIER1_OXIDES,
                Material::TIER1_BIOCELLS,
                Material::TIER1_SUPERCONDUCTORS,
            ],
            Material::TIER2_GUIDANCE_SYSTEMS => [
                Material::TIER1_WATER_COOLED_CPU,
                Material::TIER1_TRANSMITTER,
            ],
            Material::TIER2_HAZMAT_DETECTION_SYSTEMS => [
                Material::TIER1_POLYTEXTILES,
                Material::TIER1_VIRAL_AGENT,
                Material::TIER1_TRANSMITTER,
            ],
            Material::TIER2_HERMETIC_MEMBRANES => [
                Material::TIER1_POLYARAMIDS,
                Material::TIER1_GENETICALLY_ENHANCED_LIVESTOCK,
            ],
            Material::TIER2_HIGH_TECH_TRANSMITTERS => [
                Material::TIER1_POLYARAMIDS,
                Material::TIER1_TRANSMITTER,
            ],
            Material::TIER2_INDUSTRIAL_EXPLOSIVES => [
                Material::TIER1_FERTILIZER,
                Material::TIER1_POLYTEXTILES,
            ],
            Material::TIER2_NEOCOMS => [
                Material::TIER1_BIOCELLS,
                Material::TIER1_SILICATE_GLASS,
            ],
            Material::TIER2_NUCLEAR_REACTORS => [
                Material::TIER1_ENRICHED_URANIUM,
                Material::TIER1_MICROFIBER_SHIELDING,
            ],
            Material::TIER2_PLANETARY_VEHICLES => [
                Material::TIER1_SUPERTENSILE_PLASTICS,
                Material::TIER1_MECHANICAL_PARTS,
                Material::TIER1_MINIATURE_ELECTRONICS,
            ],
            Material::TIER2_ROBOTICS => [
                Material::TIER1_MECHANICAL_PARTS,
                Material::TIER1_CONSUMER_ELECTRONICS,
            ],
            Material::TIER2_SMARTFAB_UNITS => [
                Material::TIER1_CONSTRUCTION_BLOCKS,
                Material::TIER1_MINIATURE_ELECTRONICS,
            ],
            Material::TIER2_SUPERCOMPUTERS => [
                Material::TIER1_WATER_COOLED_CPU,
                Material::TIER1_COOLANT,
                Material::TIER1_CONSUMER_ELECTRONICS,
            ],
            Material::TIER2_SYNTHETIC_SYNAPSES => [
                Material::TIER1_SUPERTENSILE_PLASTICS,
                Material::TIER1_TEST_CULTURES,
            ],
            Material::TIER2_TRANSCRANIAL_MICROCONTROLLERS => [
                Material::TIER1_BIOCELLS,
                Material::TIER1_NANITES,
            ],
            Material::TIER2_UKOMI_SUPERCONDUCTORS => [
                Material::TIER1_SYNTHETIC_OIL,
                Material::TIER1_SUPERCONDUCTORS,
            ],
            Material::TIER2_VACCINES => [
                Material::TIER1_LIVESTOCK,
                Material::TIER1_VIRAL_AGENT,
            ],
        ];

        foreach ($tier2 as $output => $input) {
            $output = EVE::universe()->type($output);
            $outputConstName = mb_strtoupper(str_replace([' ', '-'], '_', trim($output->name)));
            $inputArr = [];
            foreach ($input as $id) {
                $type = EVE::universe()->type($id);
                $constName = mb_strtoupper(str_replace([' ', '-'], '_', trim($type->name)));
                $inputArr[] = "Material::TIER1_{$constName} => 10,";
            }
            $inputStr = implode(PHP_EOL, $inputArr);
            $class = <<<CLASS
<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\\tier2;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class BroadcastNode extends Schematic
{
    const OUTPUT = [Material::TIER2_{$outputConstName} => 3];
    
    const INPUT = [
        {$inputStr}
    ];
}

CLASS;

            $fileName = str_replace(' ', '', ucwords(str_replace('-', ' ', $output->name)));
            var_dump(file_put_contents('/var/www/html/eve/components/pi/schematics/tier2/' . $fileName . '.php', $class));
        }
    }

}
