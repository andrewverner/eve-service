<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 14:06
 */

namespace app\assets;

use yii\web\AssetBundle;

class CharacterAsset extends AssetBundle
{
    public $css = [
        'css/character.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'app\assets\AppAsset',
    ];
}
