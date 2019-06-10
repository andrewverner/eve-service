<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.06.19
 * Time: 13:20
 */

namespace app\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $js = [
        'js/map.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
