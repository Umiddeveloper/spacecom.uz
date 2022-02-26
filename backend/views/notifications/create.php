<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Notifications */

$this->title = Yii::t('app', 'Create Notifications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
