<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 8:16
 */

namespace app\assets;

use yii\web\AssetBundle;

class KillMailAsset extends AssetBundle
{
    public $css = [
        'css/kill-mail.css'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
    ];
}
