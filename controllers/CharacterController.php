<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 05.10.18
 * Time: 14:25
 */

namespace app\controllers;

use app\components\esi\assets\CharacterAssetsList;
use app\components\esi\bookmarks\CharacterBookmarkFolder;
use app\components\esi\EVE;
use app\components\esi\location\CharacterLocation;
use app\models\CharacterRoute;
use app\models\Scope;
use app\models\Token;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
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
        $mailId = \Yii::$app->request->getQueryParam('mailId');
        $mailBody = $character->mailBody($mailId);

        if (!$mailBody) {
            throw new NotFoundHttpException('Mail not found');
        }

        $data = $this->renderPartial('_mail-body', [
            'mailBody' => $mailBody,
            'write' => $token->can(Scope::SCOPE_MAIL_WRITE),
            'update' => $token->can(Scope::SCOPE_MAIL_UPDATE_DELETE),
            'characterId' => $character->characterId,
            'mailId' => $mailId,
        ]);
        $this->asJson(['data' => $data]);
    }

    public function actionDropMail()
    {

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
        $data = $character->bookmarks();

        $bookmarks = [];
        foreach ($data as $bookmark) {
            $bookmarks[$bookmark->folderId][] = $bookmark;
        }

        $foldersData = $character->bookmarksFolders();
        $folders = [];
        foreach ($foldersData as $folder) {
            $folders[$folder->folderId] = $folder;
        }

        return $this->render('bookmarks', [
            'character' => $character,
            'bookmarks' => $bookmarks,
            'folders' => $folders,
        ]);
    }

    public function actionCalendar($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('calendar', [
            'events' => $character->calendarEvents(),
            'character' => $character,
        ]);
    }

    public function actionBuildMap()
    {
        /*if (!\Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('Page not found');
        }*/

        $id = \Yii::$app->request->getQueryParam('id');
        $token = $this->getToken($id);
        if (!$token->can(Scope::SCOPE_ONLINE_READ) || !$token->can(Scope::SCOPE_LOCATION_READ)) {
            throw new BadRequestHttpException('Can\'t access character online status or location');
        }

        $character = $token->character();
        $online = $character->online();
        if (!$online->online) {
            //throw new BadRequestHttpException('Character is offline');
        }

        $location = $character->location();
        /**
         * @var CharacterLocation $previousLocation
         */
        $previousLocation = \Yii::$app->cache->get("character-map:{$character->characterId}:last-location", null);
        \Yii::$app->cache->set("character-map:{$character->characterId}:last-location", serialize($location));
        if ($previousLocation) {
            $previousLocation = unserialize($previousLocation);
            if ($previousLocation->solarSystemId != $location->solarSystemId) {
                //save to map
            }
        }
    }

    public function actionRoutes($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();
        $this->view->registerJsVar('characterId', $character->characterId);
        $routeCacheKey = "character:{$id}:recorder:route";
        $routeData = \Yii::$app->cache->get($routeCacheKey);
        $route = $routeData ? unserialize($routeData) : [];

        return $this->render('routes', [
            'character' => $character,
            'route' => $route,
            'models' => CharacterRoute::find()->where(['character_id' => $id])->all()
        ]);
    }

    public function actionRecordRoute($id)
    {
        /*if (!\Yii::$app->request->isAjax) {
            throw new MethodNotAllowedHttpException('Method not allowed');
        }

        if (!\Yii::$app->request->isPost) {
            throw new MethodNotAllowedHttpException('Method not allowed');
        }*/

        $token = $this->getToken($id);
        $character = $token->character();

        if (!$token->can(Scope::SCOPE_LOCATION_READ)) {
            throw new BadRequestHttpException('Bad request');
        }

        if (!$character->online()->online) {
            throw new BadRequestHttpException('Character is offline');
        }

        $stations = \Yii::$app->request->post('stations') == 'true';
        $wormholes = \Yii::$app->request->post('wormholes') == 'true';
        $ship = \Yii::$app->request->post('ship') == 'true';

        $previousLocationCacheKey = "character:{$id}:recorder:lastLocation";
        $routeCacheKey = "character:{$id}:recorder:route";
        /*\Yii::$app->cache->delete($routeCacheKey);
        \Yii::$app->cache->delete($previousLocationCacheKey);*/
        $previousLocationId = \Yii::$app->cache->get($previousLocationCacheKey);
        $routeData = \Yii::$app->cache->get($routeCacheKey);
        $route = $routeData ? unserialize($routeData) : [];
        $currentLocation = $character->location();

        if ($currentLocation->stationId && !$stations) {
            $data = $this->renderPartial('route-recorder', ['route' => $route]);
            return $this->asJson(['data' => $data]);
        }

        if (!$currentLocation->stationId && !$wormholes) {
            $system = EVE::universe()->solarSystem($currentLocation->solarSystemId);
            if (preg_match('/^J[0-9]{6}$/', $system->name)) {
                $data = $this->renderPartial('route-recorder', ['route' => $route]);
                return $this->asJson(['data' => $data]);
            }
        }

        $currentLocationId = $currentLocation->stationId ?: $currentLocation->solarSystemId;

        if ($currentLocationId != $previousLocationId) {
            $shipData = $ship ? $character->ship() : null;

            $route[] = [
                'id' => $currentLocationId,
                'time' => time(),
                'type' => $currentLocation->stationId ? 'station' : 'solarSystem',
                'ship' => $shipData ? [
                    'type' => EVE::universe()->type($shipData->shipTypeId)->name,
                    'name' => $shipData->shipName,
                ] : null
            ];
            \Yii::$app->cache->set($routeCacheKey, serialize($route));
            \Yii::$app->cache->set($previousLocationCacheKey, $currentLocationId);
        }

        $data = $this->renderPartial('route-recorder', ['route' => $route]);

        return $this->asJson([
            'data' => $data,
            'rows' => count($route),
        ]);
    }

    public function actionDropRouteRecord($id)
    {
        $routeCacheKey = "character:{$id}:recorder:route";
        $routeData = \Yii::$app->cache->get($routeCacheKey);
        $route = $routeData ? unserialize($routeData) : [];
        $index = \Yii::$app->request->post('index');
        unset($route[$index]);
        \Yii::$app->cache->set($routeCacheKey, serialize($route));
    }

    public function actionSaveRoute($id)
    {
        $routeCacheKey = "character:{$id}:recorder:route";
        $routeData = \Yii::$app->cache->get($routeCacheKey);
        if (!$routeData) {
            echo 'Route not found';
            return;
        }

        $name = \Yii::$app->request->post('name');
        $clear = \Yii::$app->request->post('clear') == 'true';
        if (!$name) {
            echo 'Name not found';
            return;
        }

        $model = new CharacterRoute();
        $model->character_id = $id;
        $model->name = $name;
        $model->route = $routeData;
        if (!$model->validate()) {
            print_r($model->errors);
        }
        $model->save();

        if ($clear) {
            $previousLocationCacheKey = "character:{$id}:recorder:lastLocation";
            \Yii::$app->cache->delete($routeCacheKey);
            \Yii::$app->cache->delete($previousLocationCacheKey);
        }

        $route = $clear ? [] : unserialize($routeData);
        $data = $this->renderPartial('route-recorder', ['route' => $route]);
        return $this->asJson([
            'data' => $data,
            'rows' => $clear ? 0 : count($route)
        ]);
    }

    public function actionRoute($id, $route)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        $model = CharacterRoute::find()->where([
            'character_id' => $id,
            'id' => $route
        ])->one();
        $this->view->registerJsVar('characterId', $character->characterId);

        return $this->render('route', [
            'model' => $model,
            'character' => $character,
            'canWriteWaypoints' => $token->can(Scope::SCOPE_WAY_POINT_WRITE)
        ]);
    }

    public function actionSetRoute($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        if (!$token->can(Scope::SCOPE_WAY_POINT_WRITE)) {
            return;
        }

        $model = CharacterRoute::find()->where([
            'character_id' => $id,
            'id' => \Yii::$app->request->post('route')
        ])->one();
        if (!$model) {
            return;
        }

        if (!$character->online()) {
            throw new BadRequestHttpException('Character is offline');
        }

        $route = unserialize($model->route);

        if (\Yii::$app->request->post('reverse')) {
            $route = array_reverse($route);
        }
        if (\Yii::$app->request->post('fromCurrentLocation')) {
            $currentLocation = $character->location();
            if ($currentLocation) {
                $currentLocationId = $currentLocation->stationId ?: $currentLocation->solarSystemId;
                foreach ($route as $index => $locationData) {
                    if ($locationData['id'] == $currentLocationId) {
                        $route = array_slice($route, $index);
                        continue;
                    }
                }
            }
        }
        if (\Yii::$app->request->post('skipStations')) {
            $route = array_filter($route, function ($location) {
                return $location['type'] != 'station';
            });
        }
        if (\Yii::$app->request->post('startEnd')) {
            $route = [
                reset($route),
                end($route)
            ];
        }

        $clearWaypoints = \Yii::$app->request->post('clearWaypoints');
        $index = 0;
        foreach ($route as $location) {
            $character->addWayPoint($location['id'], false, $clearWaypoints && $index == 0);
            $index++;
            sleep(1);
        }
    }

    public function actionClearRoute($id)
    {
        $previousLocationCacheKey = "character:{$id}:recorder:lastLocation";
        $routeCacheKey = "character:{$id}:recorder:route";
        \Yii::$app->cache->delete($routeCacheKey);
        \Yii::$app->cache->delete($previousLocationCacheKey);
    }

    public function actionShareRoute($id)
    {
        $route = CharacterRoute::find()->where([
            'character_id' => $id,
            'id' => \Yii::$app->request->post('route')
        ])->one();

        if (!$route) {
            throw new NotFoundHttpException('Route not found');
        }

        $route->share = \Yii::$app->request->post('share');
        $route->save();
    }

    public function actionWallet($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('wallet', [
            'character' => $character,
            'wallet' => $character->wallet()
        ]);
    }

    public function actionKillMails($id)
    {
        $token = $this->getToken($id);
        $character = $token->character();

        return $this->render('kill-mails', [
            'character' => $character,
            'killMails' => $character->killMails()
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
