<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\models\Token;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionQueue()
    {
        $this->layout = false;
        $token = Token::findOne(6);
        return $this->render('skill-queue', [
            'queue' => $token->character()->skillQueue(),
            'character' => $token->character(),
        ]);
    }
}
