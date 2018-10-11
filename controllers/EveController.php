<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 12:29
 */

namespace app\controllers;

use app\components\esi\EVE;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EveController extends Controller
{
    public function actionType()
    {
        if (!\Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('Page not found');
        }

        $typeId = \Yii::$app->request->getQueryParam('typeId');
        if (!$typeId) {
            throw new BadRequestHttpException('Type id not found');
        }

        $type = EVE::universe()->type($typeId);
        return $this->asJson($type);
    }
}
