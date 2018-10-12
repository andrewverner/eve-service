<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.10.18
 * Time: 11:11
 */

namespace app\assets;

use yii\web\AssetBundle;

class MailListAsset extends AssetBundle
{
    public $css = [
        'css/mail-list.css',
    ];
    public $js = [
        'js/mail-list.js',
    ];
    public $depends = [
        'app\assets\CharacterAsset',
        'yii\web\JqueryAsset',
    ];
}
