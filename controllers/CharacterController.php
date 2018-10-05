<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 14:25
 */

namespace app\controllers;

use app\models\Token;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CharacterController extends Controller
{
    public function init()
    {
        $this->layout = 'character-layout';
    }

    public function actionIndex($id)
    {
        $token = Token::findOne(['character_id' => $id]);
        if (!$token || $token->user_id != \Yii::$app->user->id) {
            throw new NotFoundHttpException('Character not found');
        }
        $character = $token->getCharacter();

        return $this->render('index', [
            'character' => $character,
            'token' => $token,
        ]);
    }
}
