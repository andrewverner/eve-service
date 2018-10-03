<?php

namespace app\controllers;

use app\models\Hash;
use app\models\RegForm;
use app\models\User;
use DenisKhodakovskiyESI\EVESwaggerAPI;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $api = new EVESwaggerAPI();
        $alliancesList = [];
        try {
            $alliancesList = $api->eve()->alliancesList();
        } catch (\Exception $exception) {

        }
        return $this->render('index', ['alliances' => $alliancesList]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegistration()
    {
        $model = new RegForm();

        if ($data = Yii::$app->request->post('RegForm')) {
            $model->setAttributes($data);
            if ($model->validate()) {
                $user = new User();
                $user->username = $model->username;
                $user->password = md5($model->password1);
                $user->email = $model->email;
                if ($user->save()) {
                    Hash::create($user->id);

                    return $this->redirect(Yii::$app->urlManager->createUrl('site/reg-complete'));
                }
            }
        }

        return $this->render('registration', ['model' => $model]);
    }

    public function actionRegComplete()
    {
        return $this->render('reg-complete');
    }

    public function actionActivate($code)
    {
        /**
         * @var Hash $hash
         */
        $hash = Hash::find()->where([
            'type' => Hash::TYPE_ACTIVATE_ACCOUNT,
            'is_used' => 0,
            'value' => $code,
        ])->one();

        if (!$hash) {
            echo 'Not found';
            return;
        }

        if (new \DateTime($hash->expired) <= new \DateTime()) {
            echo 'Expired';
            return;
        }

        $user = User::findOne($hash->user_id);
        $user->active = 1;
        if ($user->save()) {
            $hash->is_used = 1;
            $hash->save();
        }
    }
}
