<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 14:25
 */

namespace app\controllers;

use app\components\esi\assets\CharacterAssetsList;
use app\models\Scope;
use app\models\Token;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CharacterController extends Controller
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
            'location' => $character->location(),
            'ship' => $character->ship(),
            'skillQueue' => $character->skillQueue(),
        ]);
    }

    public function actionAssets($id)
    {
        $page = \Yii::$app->request->getQueryParam('page', 1);

        $token = $this->getToken($id);
        $character = $token->character();

        $assets = $character->assets($page);

        return $this->render('assets', [
            'character' => $character,
            'assets' => new CharacterAssetsList($assets),
            'location' => $character->location(),
            'online' => $character->online(),
        ]);
    }

    public function actionBps($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('blueprints', [
            'character' => $character,
            'blueprints' => $character->blueprints(),
        ]);
    }

    public function actionMailList($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        if (\Yii::$app->request->isAjax) {
            $lastId = \Yii::$app->request->getQueryParam('lastId');
            $mails = $character->mailList($lastId);
            $list = $this->renderPartial('_mail-list', [
                'characterId' => $character->characterId,
                'list' => $mails,
            ]);

            return $this->asJson([
                'data' => $list,
                'count' => count($mails),
            ]);
        } else {
            return $this->render('mail-list', [
                'character' => $character,
                'list' => $character->mailList(),
            ]);
        }
    }

    public function actionMailBody()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('Page not found');
        }

        $token = $this->getToken(\Yii::$app->request->getQueryParam('characterId'));
        $character = $token->character();
        $mailBody = $character->mailBody(\Yii::$app->request->getQueryParam('mailId'));

        if (!$mailBody) {
            throw new NotFoundHttpException('Mail not found');
        }

        $data = $this->renderPartial('_mail-body', [
            'mailBody' => $mailBody,
            'write' => $token->can(Scope::SCOPE_MAIL_WRITE),
            'update' => $token->can(Scope::SCOPE_MAIL_UPDATE_DELETE),
        ]);
        $this->asJson(['data' => $data]);
    }

    public function actionAgents($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('agents', [
            'agents' => $character->agentsResearch(),
            'token' => $token,
            'character' => $character,
        ]);
    }

    public function actionBookmarks($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();
        $bookmarks = $character->bookmarks();

        $folders = [];
        foreach ($bookmarks as $bookmark) {
            $folders[$bookmark->folderId][] = $bookmark;
        }

        $folders = [];


        return $this->render('bookmarks', [
            'bookmarks' => $folders,
            'token' => $token,
            'character' => $character,
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
