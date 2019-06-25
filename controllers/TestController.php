<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\models\Service;
use app\models\Token;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $token = Token::findOne(3);
        var_dump($token->getServices());
    }
}
