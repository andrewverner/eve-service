<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 18:32
 */

namespace app\controllers;

use yii\web\Controller;

class GeneratorController extends Controller
{
    public function actionClass()
    {
        return $this->render('class');
    }
}
