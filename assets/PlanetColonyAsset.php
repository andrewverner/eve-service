<?php

namespace app\assets;

use yii\web\AssetBundle;

class PlanetColonyAsset extends AssetBundle
{
    public $js = [
        '/js/planet-colony.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
