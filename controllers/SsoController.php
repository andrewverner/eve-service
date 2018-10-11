<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 21:32
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\models\Token;
use yii\db\Expression;
use yii\web\Controller;

class SsoController extends Controller
{
    public function actionAuth()
    {
        $sso = EVE::sso();
        $code = \Yii::$app->request->getQueryParam('code');
        if (!$code) {
            return false;
        }

        $ssoToken = $sso->getAccessToken($code);
        if (!$ssoToken) {
            return false;
        }

        $verify = $sso->verify($ssoToken->accessToken);
        if (!$verify) {
            return false;
        }

        $token = Token::findOne([
            'character_id' => $verify->characterID,
            'user_id' => \Yii::$app->user->id,
        ]);

        if (!$token) {
            $token = new Token();
        }

        $token->expires_on = $verify->expiresOn->format('Y-m-d H:i:s');
        $token->scopes = serialize($verify->scopes);
        $token->refresh_token = $ssoToken->refreshToken;
        $token->access_token = $ssoToken->accessToken;

        if ($token->isNewRecord) {
            $token->character_id = $verify->characterID;
            $token->character_name = $verify->characterName;
            $token->token_type = $verify->tokenType;
            $token->character_owner_hash = $verify->characterOwnerHash;
            $token->intellectual_property = $verify->intellectualProperty;
            $token->user_id = \Yii::$app->user->id;
            $token->created = new Expression('NOW()');
        }

        if ($token->validate()) {
            $token->save();

            return $this->redirect(\Yii::$app->urlManager->createUrl('my'));
        } else {
            print_r($token->errors);
        }
    }
}
