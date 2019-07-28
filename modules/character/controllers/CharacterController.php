<?php

namespace app\modules\character\controllers;

use app\assets\CharacterAsset;
use app\components\esi\assets\CharacterAssetItem;
use app\components\esi\assets\CharacterAssetsList;
use app\components\esi\character\Character;
use app\components\esi\character\CharacterBlueprint;
use app\components\esi\EVE;
use app\components\esi\industry\CharacterIndustryJob;
use app\components\esi\universe\Planet;
use app\models\CharacterService;
use app\models\Service;
use app\models\services\ServiceFactory;
use app\models\services\SkillQueueNotificatorSettings;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `Character` module
 */
class CharacterController extends Controller
{
    /**
     * @var Character
     */
    private $character;

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        $this->character = Yii::$app->character->token->character();

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAgents()
    {
        return $this->render('agents', ['researches' => $this->character->agentsResearch()]);
    }

    public function actionAssets()
    {
        $assets = [];
        $page = 1;

        while ($data = $this->character->assets($page)) {
            $assets = array_merge($assets, $data);
            $page++;
        }

        return $this->render('assets', [
            'assets' => new CharacterAssetsList($assets),
        ]);
    }

    public function actionBps()
    {
        $blueprints = [];
        $page = 1;

        while ($bps = $this->character->blueprints($page)) {
            $blueprints = array_merge($blueprints, $bps);
            $page++;
        }

        usort($blueprints, function (CharacterBlueprint $first, CharacterBlueprint $second) {
            return $first->getType()->name <=> $second->getType()->name;
        });

        $dataProvider = new ArrayDataProvider([
            'allModels' => $blueprints,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('blueprints', ['dataProvider' => $dataProvider]);
    }

    public function actionCalendar()
    {
        $calendar = $this->character->calendar();

        return $this->render('calendar', ['calendar' => $calendar]);
    }

    public function actionIndustryJobs()
    {
        $jobs = $this->character->industryJobs(false);

        usort($jobs, function (CharacterIndustryJob $first, CharacterIndustryJob $second) {
            return $first->endDate <=> $second->endDate;
        });

        return $this->render('industry-jobs', [
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $jobs,
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]),
        ]);
    }

    public function actionService($code)
    {
        $service = Service::findOne(['code' => $code]);
        if (!$service) {
            throw new NotFoundHttpException('Service not found');
        }

        $characterService = CharacterService::findOne([
            'service_id' => $service->id,
            'character_id' => $this->character->characterId,
        ]);

        return $this->render('skill-queue-notificator', ['settings' => $characterService->settings()]);
    }

    public function actionPlanetary()
    {
        $planets = $this->character->planets();

        return $this->render('planetary', ['planets' => $planets]);
    }

    public function actionPlanet($planetId)
    {
        $planetColony = $this->character->planet($planetId);

        return $this->render('planet-colony', [
            'colony' => $planetColony,
            'planet' => new Planet(['planet_id' => $planetId]),
        ]);
    }
}
