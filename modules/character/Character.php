<?php

namespace app\modules\character;

use Yii;
use yii\base\Theme;
use yii\base\Module;

/**
 * Character module definition class
 */
class Character extends Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\character\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(Yii::$app->urlManager->createUrl('sign-in'))->send();
        }

        Yii::$app->view->theme = new Theme([
            'pathMap' => ['@app/views' => '@app/modules/character/views'],
            'baseUrl' => '@web/character',
        ]);
    }
}
