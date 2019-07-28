<?php

namespace app\modules\character\widgets;

use app\components\esi\planetary\PlanetColony;
use app\components\esi\planetary\PlanetColonyPin;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class PlanetColonyWidget extends Widget
{
    /**
     * @var PlanetColony
     */
    public $colony;

    public function run()
    {
        if (!$this->colony->pins) {
            return '';
        }

        $pins = ArrayHelper::index($this->colony->pins, 'pinId');
        $pins = array_filter($pins, function (PlanetColonyPin $pin) {
            return !$pin->isExtractor();
        });

        $latitudes = array_column($pins, 'latitude');
        $longitudes = array_column($pins, 'longitude');

        $minLat = min($latitudes);
        $maxLat = max($latitudes);
        $minLon = min($longitudes);
        $maxLon = max($longitudes);

        return $this->render('colony-schematic', [
            'colony' => $this->colony,
            'pins' => $pins,
            'minLat' => $minLat,
            'minLon' => $minLon,
            'height' => floor(($maxLat - $minLat) * PlanetColony::SVG_MULTIPLIER) + 100,
            'width' => floor(($maxLon - $minLon) * PlanetColony::SVG_MULTIPLIER) + 100,
        ]);
    }
}
