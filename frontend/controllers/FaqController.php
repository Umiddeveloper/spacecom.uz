<?php

namespace frontend\controllers;

use backend\models\Faq;
use frontend\models\CreateFaqForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class FaqController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create-faq'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new CreateFaqForm();
        $faqs = Faq::find()->where(['status' => Faq::STATUS_PUBLIC])->limit(10)->all();
        return $this->render('index', [
            'model' => $model,
            'faqs' => $faqs
        ]);
    }

    public function actionCreateFaq()
    {
        $faqs = Faq::find()->where(['status' => Faq::STATUS_PUBLIC])->limit(10)->all();
        $model = new CreateFaqForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Success.');
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'faqs' => $faqs,
            'model' => $model,
        ]);
    }
}
