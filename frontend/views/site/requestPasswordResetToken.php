<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = Yii::t('app','Request password reset');
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
                    <p><?=Yii::t('app','Please fill out your email. A link to reset password will be sent there.')?></p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="comment-form">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div><!-- /.comment-form -->
            </div>
        </div>
    </div>
</section>