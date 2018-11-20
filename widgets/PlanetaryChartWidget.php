<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.18
 * Time: 15:19
 */

namespace app\widgets;

use app\components\esi\EVE;
use app\components\pi\Planet;
use yii\base\Widget;
use yii\helpers\FileHelper;

class PlanetaryChartWidget extends Widget
{
    public function run()
    {
        $data = FileHelper::findFiles(\Yii::getAlias('@app/components/pi/planets'), ['only'=>['*.php']]);
        /**
         * @var Planet[] $planets
         */
        $planets = [];
        foreach ($data as $planet) {
            $planetName = basename(str_replace('.php', '', $planet));
            $r = new \ReflectionClass('app\components\pi\planets\\' . $planetName);
            /**
             * @var Planet $planetClass
             */
            $planetClass = $r->newInstance();
            $planets[] = $planetClass;
        }

        $materials = [];
        foreach ($planets as $planet) {
            $materials = array_merge($materials, $planet->getMaterials());
        }

        usort($planets, function ($first, $second) {
            /**
             * @var Planet $first
             * @var Planet $second
             */
            return $first->getClass() <=> $second->getClass();
        });

        usort($materials, function ($first, $second) {
            return EVE::universe()->type($first)->name <=> EVE::universe()->type($second)->name;
        });

        return $this->render('pi-chart', [
            'planets' => $planets,
            'materials' => array_unique($materials),
        ]);
    }
}
