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
use app\components\pi\Material;
use app\models\CharacterRoute;
use yii\helpers\FileHelper;
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
        $tier = [
            Material::MATERIAL_BACTERIA => [Material::RAW_MATERIAL_MICROORGANISMS],
            Material::MATERIAL_BIOFUELS => [Material::RAW_MATERIAL_CARBON_COMPOUNDS],
            Material::MATERIAL_BIOMASS => [Material::RAW_MATERIAL_PLANKTIC_COLONIES],
            Material::MATERIAL_CHIRAL_STRUCTURES => [Material::RAW_MATERIAL_NON_CS_CRYSTALS],
            Material::MATERIAL_ELECTROLYTES => [Material::RAW_MATERIAL_IONIC_SOLUTIONS],
            Material::MATERIAL_INDUSTRIAL_FIBERS => [Material::RAW_MATERIAL_AUTOTROPHS],
            Material::MATERIAL_OXIDIZING_COMPOUND => [Material::RAW_MATERIAL_REACTIVE_GAS],
            Material::MATERIAL_OXYGEN => [Material::RAW_MATERIAL_NOBLE_GAS],
            Material::MATERIAL_PLASMOIDS => [Material::RAW_MATERIAL_SUSPENDED_PLASMA],
            Material::MATERIAL_PRECIOUS_METALS => [Material::RAW_MATERIAL_NOBLE_METALS],
            Material::MATERIAL_PROTEINS => [Material::RAW_MATERIAL_COMPLEX_ORGANISMS],
            Material::MATERIAL_REACTIVE_METALS => [Material::RAW_MATERIAL_BASE_METALS],
            Material::MATERIAL_SILICON => [Material::RAW_MATERIAL_FELSIC_MAGMA],
            Material::MATERIAL_TOXIC_METALS => [Material::RAW_MATERIAL_HEAVY_METALS],
            Material::MATERIAL_WATER => [Material::RAW_MATERIAL_AQUEOUS_LIQUIDS],
        ];

        foreach ($tier as $output => $input) {
            $output = EVE::universe()->type($output);
            $outputConstName = mb_strtoupper(str_replace([' ', '-'], '_', trim($output->name)));
            $inputArr = [];
            foreach ($input as $id) {
                $type = EVE::universe()->type($id);
                $constName = mb_strtoupper(str_replace([' ', '-'], '_', trim($type->name)));
                $inputArr[] = "        Material::RAW_MATERIAL_{$constName} => 3000,";
            }
            $inputStr = implode(PHP_EOL, $inputArr);
            $fileName = str_replace(' ', '', ucwords(str_replace('-', ' ', $output->name)));
            $class = <<<CLASS
<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 17:39
 */

namespace app\components\pi\schematics\\base;

use app\components\pi\Material;
use app\components\pi\schematics\Schematic;

class {$fileName} extends Schematic
{
    const OUTPUT = [Material::MATERIAL_{$outputConstName} => 40];
    
    const INPUT = [
{$inputStr}
    ];
}

CLASS;

            var_dump(file_put_contents('/var/www/html/eve/components/pi/schematics/base/' . $fileName . '.php', $class));
        }
    }

    public function actionAlias()
    {
        $schematics = FileHelper::findFiles(\Yii::getAlias('@app/components/pi/schematics/base'), ['only'=>['*.php']]);
        $className = str_replace('.php', '', $schematics[5]);
        $r = new \ReflectionClass('app\components\pi\schematics\base\\' . basename($className));
        var_dump($r->newInstance());

    }

    public function actionPlanets()
    {
        echo '<pre>';
        $system = EVE::universe()->ids(['Raussinen'])->systems[0];
        $planet = $system->planets[0];
        print_r($planet->type());
    }
}
