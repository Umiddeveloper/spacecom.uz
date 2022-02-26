<?php

use backend\models\Faq;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Faqs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Faq'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                            'attribute' => 'user_id',
                            'label' => Yii::t('app','User ID'),
                            'format' => 'html',
                            'value' => function($model){
                                return Yii::t('app','User Name') . ': ' . (isset($model->user->full_name) ? $model->user->full_name : $model->user->username ). '<br>' . Yii::t('app','User Name') . ': ' . $model->user->email;
                            },
                    ],
                    'question:ntext',
                    'answer:ntext',
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return Faq::getStatus()[$model->status];
                        },
                        'filter' => Faq::getStatus()
                    ],
                    [
                        'format' => 'html',
                        'value' => function($model){
                            if($model->status == Faq::STATUS_NEW) {
                                return Html::a(Yii::t('app','Reply'), ['reply', 'id' => $model->id], ['class' => 'btn btn-info']);
                            }else{
                                return '';
                            }
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Yii::$app->user->can('admin') ? '{view}  {update} {delete}' : '{view}  {update}',
                    ],
                ],
            ]) ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
