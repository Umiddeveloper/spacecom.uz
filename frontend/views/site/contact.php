<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app', 'Contacts');
?>

<div class="container">
    <?php
    if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><?= Yii::t('app', 'Thank you for contacting us. We will get back to you as soon as possible.') ?></div>
    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger"><?= Yii::t('app', 'Error occurred:') ?></div>
    <?php else: ?>
    <?php endif; ?>
</div>

<div class="container">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'full_name')->textInput(['maxlength' => 255, 'placeholder' => Yii::t('app', 'Name'), 'class' => 'form-control'])->label(false) ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?= $form->field($model, 'email_phone')->textInput(['maxlength' => 255, 'placeholder' => Yii::t('app', 'Phone'), 'class' => 'form-control'])->label(false) ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= $form->field($model, 'message')->textarea(['rows' => '10', 'placeholder' => Yii::t('app', 'Message'), 'class' => 'form-control'])->label(false) ?>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha2::class,
                    [
                        'options' => ['class' => 'form-control mb-30']
                    ]
                )->label(false) ?>
            </div>
        </div>

        <div class="col-md-12 text-center">
            <input type="submit" class="btn btn-clean" value="<?= Yii::t('app', 'Send') ?>"/>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
