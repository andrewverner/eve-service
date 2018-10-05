<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.10.18
 * Time: 8:47
 */

namespace app\assets;

use yii\web\AssetBundle;

class RegistrationAsset extends AssetBundle {
    public $css = [
        'css/registration.css',
    ];
    public $js = [
        'js/registration.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
