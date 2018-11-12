<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 10:09
 */

namespace app\assets;

use yii\web\AssetBundle;

class RoutesAsset extends AssetBundle
{
    public $js = [
        'js/routes.js'
    ];
    public $css = [
        'css/route.css'
    ];
    public $depends = [
        'app\assets\AppAsset',
        'app\assets\CharacterAsset',
    ];
}
