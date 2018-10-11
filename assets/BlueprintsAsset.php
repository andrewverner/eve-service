<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 10:09
 */

namespace app\assets;

use yii\web\AssetBundle;

class BlueprintsAsset extends AssetBundle
{
    public $css = [
        'css/blueprints.css'
    ];
    public $js = [
        'js/blueprints.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
        'app\assets\CharacterAsset',
        'yii\web\JqueryAsset',
    ];
}
