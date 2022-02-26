<?php

use backend\models\Notifications;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Notifications */

$this->title = Yii::t('app','Notification #') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notifications-view">
    <?php if(Yii::$app->user->can('admin')): ?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php if($model->status == Notifications::STATUS_DRAFT):?>
            <?= Html::a(Yii::t('app', 'Activate Notification'), ['change', 'id' => $model->id, 'status' => Notifications::STATUS_ACTIVE], [
                'class' => 'btn btn-success',
            ]) ?>
        <?php elseif ($model->status == Notifications::STATUS_ACTIVE): ?>
            <?= Html::a(Yii::t('app', 'Draft Notification'), ['change', 'id' => $model->id, 'status' => Notifications::STATUS_DRAFT], [
                'class' => 'btn btn-warning',
            ]) ?>
        <?php endif;?>
    </p>


    <?php endif; ?>
    <div class="box">
        <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'message:html',
            [
                    'attribute' => 'status',
                    'value' => function($model){
                        return \backend\models\Notifications::getStatus()[$model->status];
                    }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
        </div>
    </div>
</div>
