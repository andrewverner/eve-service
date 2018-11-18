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
use app\components\pi\OceanicPlanet;
use app\components\pi\Planetary;
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
        $planetary = new Planetary();
        $planetary->addPlanet(
            new LavaPlanet(),
            new BarrenPlanet(),
            new TemperatePlanet(),
            new OceanicPlanet(),
            new StormPlanet(),
            new GasPlanet(),
            new IcePlanet()
        );
        $planetary->explore();
        echo '</pre>';
    }
}
