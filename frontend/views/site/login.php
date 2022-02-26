<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Login');
?>
<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?=Yii::t('app','Home')?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
                        </ol>
                    </nav>
                    <h3 class="title"><?= $this->title ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-shadow">
        <img src="/images/page-shadow.png" alt="">
    </div>
</div>

<section class="conatct-area pb-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="conatct-info">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p><?=Yii::t('app','Please fill out the following fields to login')?>:</p>
                    <p><?=Yii::t('app','If you don\'t have already account')?> <?=Html::a(Yii::t('app','register'),['/site/signup'],['class' => 'btn btn-link'])?></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="comment-form">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="color:#999;margin:1em 0">
                        <?=Yii::t('app','If you forgot your password you can')?> <?= Html::a(Yii::t('app','reset it'), ['site/request-password-reset']) ?>.
                        <br>
                        <?=Yii::t('app','Need new verification email?')?> <?= Html::a(Yii::t('app','Resend'), ['site/resend-verification-email']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div><!-- /.comment-form -->
            </div>
        </div>
    </div>
</section>
