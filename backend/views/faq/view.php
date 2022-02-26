<?php

use backend\models\Faq;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */

$this->title = Yii::t('app','FAQ #') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="faq-view">

    <p>
        <?php if($model->status == Faq::STATUS_NEW) {
            echo Html::a(Yii::t('app','Reply'), ['reply', 'id' => $model->id], ['class' => 'btn btn-info']);
        }
        ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?php if(Yii::$app->user->can('admin')):?>
        <?php if($model->status == Faq::STATUS_DRAFT):?>
            <?= Html::a(Yii::t('app', 'Public'), ['change', 'id' => $model->id, 'status' => Faq::STATUS_PUBLIC], [
                'class' => 'btn btn-success',
            ]) ?>
        <?php elseif ($model->status == Faq::STATUS_PUBLIC): ?>
            <?= Html::a(Yii::t('app', 'Draft'), ['change', 'id' => $model->id, 'status' => Faq::STATUS_DRAFT], [
                'class' => 'btn btn-warning',
            ]) ?>
        <?php endif;?>
        <?php endif;?>
    </p>
    <div class="box">
        <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'question:ntext',
            'answer:ntext',
            [
                'attribute' => 'status',
                'value' => function($model){
                    return Faq::getStatus()[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
        </div>
    </div>
</div>
