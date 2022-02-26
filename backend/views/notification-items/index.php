<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NotificationItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notification Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-items-index">
    <div class="box">
        <div class="box-body">
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=>"{summary}<br>\n{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'notification_id',
                    'format' => 'html',
                    'value' => 'notification.message'
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    return \backend\models\NotificationItems::getStatus()[$model->status];
                },
                'filter' => \backend\models\NotificationItems::getStatus()
            ],
            'notification.created_at:datetime',
            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
        </div>
    </div>
</div>
