<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NotificationItems */

$this->title = Yii::t('app','Notification #').$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notification Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-items-view">
    <div class="box">
        <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'notification_id',
                'format' => 'html',
                'value' => function($model){
                        return $model->notification->message;
                }
            ],
            'notification.created_at:datetime',
        ],
    ]) ?>
        </div>
    </div>
</div>
