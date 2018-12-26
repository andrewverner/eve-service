<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\models\CharacterService;
use app\models\Token;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(Token::findOne(6)->services);
    }
}
