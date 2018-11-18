<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 14:44
 */

namespace app\assets;

use yii\web\AssetBundle;

class PIAsset extends AssetBundle
{
    public $css = [
        'css/pi.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
    ];
}
