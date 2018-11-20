<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.2018
 * Time: 20:35
 */

namespace app\assets;

use yii\web\AssetBundle;

class PIChartAsset extends AssetBundle
{
    public $css = [
        'css/pi-chart.css',
    ];
    public $js = [
        'js/pi-chart.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
    ];
}
