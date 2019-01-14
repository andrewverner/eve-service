<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\esi\EVE;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(EVE::corporation(1000134));
    }
}
