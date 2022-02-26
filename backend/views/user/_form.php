<?php

use yii\helpers\ArrayHelper;use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-default">
        <div class="box-body">
            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            <?php if(!(isset($updateOwn) && $updateOwn)) : ?>
            <?= $form->field($model, 'role')->dropDownList(\common\models\User::getRoleList()) ?>
            <?= $form->field($model, 'status')->dropDownList(\common\models\User::getStatusList()) ?>
            <?php endif ?>
            <?= $form->field($model, 'chat_id')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?php if($model->isNewRecord): ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            <?php else: ?>
                <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
            <?php endif; ?>        </div>
        <div class="box-footer">

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
