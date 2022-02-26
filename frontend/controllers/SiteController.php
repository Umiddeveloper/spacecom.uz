<?php

namespace frontend\controllers;

use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\front\Items;
use afzalroq\cms\helpers\SearchHelper;
use common\models\Feedback;
use common\models\LoginForm;
use common\models\Telegram;
use Exception;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use InvalidArgumentException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index', [
            'sliders' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'slider'])->id])
                ->andWhere(['!=', 'text_1' . "_" . Yii::$app->params['l'][Yii::$app->language], ""])
                ->orderBy('date_0 DESC')
                ->all(),
            'news' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'news'])->id])
                ->andWhere(['!=', 'text_1' . "_" . Yii::$app->params['l'][Yii::$app->language], ""])
                ->andWhere(['<', 'date' . "_" . Yii::$app->params['l'][Yii::$app->language], time()])
                ->orderBy('date_0 DESC')->all(),
            'partners' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'partners'])->id])->all(),
            'photos' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'photo-gallery'])->id])->limit(9)->all(),
            'main_banner' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'main-page-banner'])->id])->andWhere(['!=', 'text_1' . "_" . Yii::$app->params['l'][Yii::$app->language], ""])->one()
        ]);
    }

    public function actionContacts()
    {
        $model = new Feedback();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                $text = htmlspecialchars(
                    Yii::t('app', 'Application send!') . " \n" .
                    Yii::t('app', 'Name') . " " . $model->full_name . "\n" .
                    Yii::t('app', 'Phone') . " " . $model->email_phone . "\n" .
                    Yii::t('app', 'Message') . " " . $model->message . "\n"
                );
                Telegram::sendMessage($text);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.'));
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error occurred:') . ' ' . $e->getMessage());
            }
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionSearch($q = '')
    {
        $q = SearchHelper::validate($q = '');
        $langId = Yii::$app->params['l'][Yii::$app->language];
        $dataProvider = new ActiveDataProvider([
            'query' => Items::find()
                ->andFilterWhere(['or',
                    ['entity_id' => Entities::findOne(['slug' => 'pages'])->id],
                    ['entity_id' => Entities::findOne(['slug' => 'news'])->id],
                ])
                ->andFilterWhere(['or',
                    ['like', 'text_1_' . $langId, $q],
                    ['like', 'text_2_' . $langId, $q],
                    ['like', 'text_3_' . $langId, $q],
                    ['like', 'text_4_' . $langId, $q],
                    ['like', 'text_5_' . $langId, $q],
                    ['like', 'text_6_' . $langId, $q],
                    ['like', 'text_7_' . $langId, $q],
                ]),
            'pagination' => [
                'pageSize' => 6,
            ]
        ]);
        return $this->render('search', [
            'dataProvider' => $dataProvider,
            'search' => $q,
            'lastItems' => Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'pages'])->id])->orderBy('date_0 DESC')->limit(3)->all(),
            'title' => Yii::t('app', 'Search')
        ]);

    }


    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

}
