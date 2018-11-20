<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.18
 * Time: 12:12
 */

namespace app\assets;

use yii\web\AssetBundle;

class TreansJSAsset extends AssetBundle
{
    public $css = [
        'css/pi.css',
        'js/treant-js/Treant.css',
    ];
    public $js = [
        'js/treant-js/vendor/raphael.js',
        'js/treant-js/Treant.js',
        'js/pi-schematic.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
    ];
}
