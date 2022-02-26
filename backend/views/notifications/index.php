<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index">

        <p>
            <?= Html::a(Yii::t('app', 'Create Notifications'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    <div class="box">
        <div class="box-body">
            <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'message:html',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return \backend\models\Notifications::getStatus()[$model->status];
                },
                'filter' => \backend\models\Notifications::getStatus()
            ],
            'created_at:datetime',
            [
                    'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
        </div>
    </div>
</div>
