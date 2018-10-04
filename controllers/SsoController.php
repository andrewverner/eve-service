<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 15:46
 */

namespace app\controllers;

use app\models\EVEAPI;
use app\models\Token;
use DenisKhodakovskiyESI\EVESwaggerAPI;
use DenisKhodakovskiyESI\src\EVESSO;
use yii\db\Exception;
use yii\db\Expression;
use yii\web\Controller;

class SsoController extends Controller
{
    /**
     * @var EVESwaggerAPI
     */
    private $api;

    /**
     * @var EVESSO
     */
    private $sso;

    public function init()
    {
        $this->api = EVEAPI::api();
        $this->sso = $this->api->sso();
    }

    public function actionIndex()
    {
        echo (new \DateTime())->format('Y-m-d H:i:s');

        /*$this->redirect($this->sso->getAuthUrl(
            $this->sso->getScopesList()
        ));*/
    }

    public function actionRegistration()
    {
        $api = EVEAPI::api();
        $sso = $api->sso();

        if ($scopes = \Yii::$app->request->post('Scopes')) {
            return $this->redirect($this->sso->getAuthUrl($scopes));
        }

        return $this->render('registration', [
            'scopes' => $sso->getScopesList()
        ]);
    }

    public function actionAuth()
    {
        if ($code = \Yii::$app->request->getQueryParam('code')) {
            $ssoToken = $this->sso->getAccessToken($code);
            if ($ssoToken) {
                $verify = $this->sso->verify($ssoToken->accessToken);
                if ($verify) {
                    $token = Token::findOne([
                        'character_id' => $verify->characterID,
                        'user_id' => \Yii::$app->user->id,
                    ]);
                    if ($token) {
                        $token->expires_on = $verify->expiresOn->format('Y-m-d H:i:s');
                        $token->scopes = serialize($verify->scopes);
                        $token->updated = new Expression('NOW()');
                        $token->user_id = \Yii::$app->user->id;
                        $token->refresh_token = $ssoToken->refreshToken;
                        $token->access_token = $ssoToken->accessToken;
                    } else {
                        $token = new Token();
                        $token->character_id = $verify->characterID;
                        $token->character_name = $verify->characterName;
                        $token->expires_on = $verify->expiresOn->format('Y-m-d H:i:s');
                        $token->token_type = $verify->tokenType;
                        $token->character_owner_hash = $verify->characterOwnerHash;
                        $token->intellectual_property = $verify->intellectualProperty;
                        $token->scopes = serialize($verify->scopes);
                        $token->created = new Expression('NOW()');
                        $token->user_id = \Yii::$app->user->id;
                        $token->refresh_token = $ssoToken->refreshToken;
                        $token->access_token = $ssoToken->accessToken;
                    }
                    if ($token->validate()) {
                        $token->save();

                        return $this->redirect(\Yii::$app->urlManager->createUrl('my'));
                    } else {
                        print_r($token->errors);
                    }
                }
            }
        }
    }
}
