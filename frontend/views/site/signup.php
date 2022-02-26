<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Signup');
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
                    <p><?=Yii::t('app','Please fill out the following fields to signup')?>:</p>
                    <p><?=Yii::t('app','If you have already account')?> <?=Html::a(Yii::t('app','login'),['/site/login'],['class' => 'btn btn-link'])?></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="comment-form">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                    <?= $form->field($model, 'full_name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'username')->textInput([]) ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app','Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div><!-- /.comment-form -->
            </div>
        </div>
    </div>
</section>
