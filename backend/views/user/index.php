<?php

use common\models\User;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'layout' => "{summary}<br>\n{items}\n{pager}",
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'username',
                        'label' => Yii::t('app', 'User ID'),
                        'format' => 'html',
                        'value' => function ($model) {
                            return (isset($model->full_name) ? $model->full_name : $model->username);
                        },
                    ],
                    [
                        'attribute' => 'role',
                        'label' => Yii::t('app', 'Role'),
                        'value' => function ($model) {
                            if (isset(User::getRoleList('view')[$model->role]))
                                return User::getRoleList('view')[$model->role];
                        },
                        'filter' => User::getRoleList('view')
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return User::getStatusList()[$model->status];
                        },
                        'filter' => User::getStatusList()
                    ],
                    'email:email',
                    'phone',
                    'chat_id',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => Yii::$app->user->can('admin') ? '{view} {update} {delete}' : '{view} {update}',
                        'buttons' => [
                            'delete' => function ($url, $model) {
                                if ($model->id != Yii::$app->user->identity->id) {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>',
                                        ['delete', 'id' => $model->id],
                                        [
                                            'data' => [
                                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                                'method' => 'post',
                                            ],
                                        ]
                                    );
                                }
                            },
                        ]
                    ],
                ],
            ]) ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
