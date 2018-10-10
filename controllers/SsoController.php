<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.10.18
 * Time: 15:46
 */

namespace app\controllers;

use app\components\esi\EVE;;

use app\components\esi\sso\SSO;
use app\models\Token;
use yii\db\Expression;
use yii\web\Controller;

class SsoController extends Controller
{
    /**
     * @var SSO
     */
    private $sso;

    public function init()
    {
        $this->sso = EVE::sso();
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
                    var_dump($token);

                    if (!$token) {
                        $token = new Token();
                    }
                    var_dump($token);

                    $token->expires_on = $verify->expiresOn->format('Y-m-d H:i:s');
                    $token->scopes = serialize($verify->scopes);
                    $token->updated = new Expression('NOW()');
                    $token->user_id = \Yii::$app->user->id;
                    $token->refresh_token = $ssoToken->refreshToken;
                    $token->access_token = $ssoToken->accessToken;

                    if ($token->isNewRecord) {
                        $token->character_id = $verify->characterID;
                        $token->character_name = $verify->characterName;
                        $token->token_type = $verify->tokenType;
                        $token->character_owner_hash = $verify->characterOwnerHash;
                        $token->intellectual_property = $verify->intellectualProperty;
                        $token->created = new Expression('NOW()');
                    }
                    var_dump($token);

                    var_dump($token->validate());
                    if ($token->validate()) {
                        //$token->save($token->isNewRecord);
                        var_dump($token->save());

                        //return $this->redirect(\Yii::$app->urlManager->createUrl('my'));
                    } else {
                        print_r($token->errors);
                    }
                }
            }
        }
    }
}
