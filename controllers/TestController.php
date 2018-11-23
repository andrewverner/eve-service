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
use app\components\pi\Planet;
use app\components\pi\Planetary;
use app\components\pi\schematics\Schematic;
use app\models\CharacterRoute;
use yii\helpers\FileHelper;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionP()
    {
        echo '<pre>';
        $planetary = new Planetary();
        $schemas = $planetary->importSchematics(
            '@app/components/pi/schematics/tier3',
            'app\components\pi\schematics\tier3'
        );

        uasort($schemas, function ($f, $s) {
            return $f::type()->name <=> $s::type()->name;
        });

        /**
         * @var Schematic[] $schemas
         */
        $str = '';
        foreach ($schemas as $schema) {
            echo $schema::type()->name . PHP_EOL;
            foreach ($schema::input() as $inputId => $quantity) {
                $str .= <<<PHP
[
    'schematic_type_id' => {$schema::typeId()},
    'input_type_id' => {$inputId},
    'quantity' => {$quantity},
],

PHP;

            }
        }
        echo $str;
    }
}
