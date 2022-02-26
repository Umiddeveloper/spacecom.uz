<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\EditProfileForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index','edit-profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['coordinator']
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'user' => $this->findModel(Yii::$app->user->identity->id)
        ]);
    }

    public function actionEditProfile()
    {
        $model = new EditProfileForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {
            Yii::$app->session->setFlash('success', 'Success.');
            return $this->redirect(['index']);
        }

        return $this->render('edit-profile', [
            'model' => $model,
        ]);
    }

    public function actionFiles()
    {
        return $this->render('files');
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
