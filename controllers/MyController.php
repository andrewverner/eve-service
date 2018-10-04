<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 04.10.18
 * Time: 9:11
 */

namespace app\controllers;

use app\models\EVEAPI;
use app\models\Token;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class MyController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        /*'actions' => ['index'],*/
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actionIndex()
    {
        $tokens = Token::findAll([
            'user_id' => \Yii::$app->user->id
        ]);

        return $this->render('index', ['tokens' => $tokens]);
    }

    public function actionAdd()
    {
        $api = EVEAPI::api();
        $sso = $api->sso();

        if ($scopes = \Yii::$app->request->post('Scopes')) {
            return $this->redirect($sso->getAuthUrl($scopes));
        }

        return $this->render('add', [
            'scopes' => $sso->getScopesList(),
        ]);
    }
}
