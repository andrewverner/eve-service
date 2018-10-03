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
        'css/registration.css'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
