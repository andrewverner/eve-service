<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 14:25
 */

namespace app\controllers;

use app\components\esi\assets\CharacterAssetsList;
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
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('index', [
            'character' => $character,
        ]);
    }

    public function actionAssets($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        $assets = $character->assets();

        return $this->render('assets', [
            'character' => $character,
            'assets' => new CharacterAssetsList($assets),
            'location' => $character->location(),
        ]);
    }

    private function getToken($id)
    {
        $token = Token::findOne([
            'character_id' => $id,
            'user_id' => \Yii::$app->user->id,
        ]);

        if (!$token || $token->user_id != \Yii::$app->user->id) {
            throw new NotFoundHttpException('Character not found');
        }

        return $token;
    }
}
