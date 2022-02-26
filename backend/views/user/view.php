<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = Yii::t('app', 'Update User #') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="user-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?php

            if (Yii::$app->authManager->getAssignment('user', $model->id)): ?>
                <?= Html::a(Yii::t('app', 'Make moderator'), ['add-moderator', 'id' => $model->id], [
                    'class' => 'btn btn-info',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to make moderator this user?'),
                        'method' => 'post',
                    ],
                ]) ?>
            <?php elseif (Yii::$app->authManager->getAssignment('moderator', $model->id)): ?>
                <?= Html::a(Yii::t('app', 'Remove moderator'), ['remove-moderator', 'id' => $model->id], [
                    'class' => 'btn btn-warning',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to remove moderator this user?'),
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif ?>
        <?php endif; ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    [
                        'label' => Yii::t('app', 'Role'),
                        'value' => function ($model) {
                            if (isset(User::getRoleList('view')[$model->role]))
                                return User::getRoleList('view')[$model->role];
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return User::getStatusList()[$model->status];
                        }
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                    'chat_id',
                ],
            ]) ?>
        </div>
    </div>
</div>
