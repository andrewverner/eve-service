<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 16:04
 */

namespace app\assets;

use yii\web\AssetBundle;

class CharacterDataAsset extends AssetBundle
{
    public $js = [
        'js/character-data.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
