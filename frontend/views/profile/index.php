<?php

/* @var $this yii\web\View */

/* @var $user common\models\User */

use yii\bootstrap4\Html;

$this->title = Yii::t('app', 'Profile');
?>
<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?= Yii::t('app', 'Home') ?></a></li>
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
                    <p>
                        <?= Html::a(Yii::t('app', 'Edit Profile'), ['edit-profile'], ['class' => 'btn btn-info']) ?>
                        <?= Html::a(Yii::t('app', 'Files'), ['files'], ['class' => 'btn btn-info']) ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="comment-form">
                    <div class="conatct-info-item">
                        <div class="item">
                            <i class="flaticon-email-1"></i>
                            <span><?= $user->getAttributeLabel('full_name') ?></span>
                            <p><?= $user->full_name ?></p>
                        </div>
                        <hr>
                        <div class="item">
                            <i class="flaticon-tick"></i>
                            <span><?= $user->getAttributeLabel('username') ?></span>
                            <p><?= $user->username ?></p>
                        </div>
                        <hr>
                        <div class="item">
                            <i class="flaticon-email"></i>
                            <span><?= $user->getAttributeLabel('email') ?></span>
                            <p><?= $user->email ?></p>
                        </div>
                        <div class="item center">
                            <i class="flaticon-calling"></i>
                            <span><?= $user->getAttributeLabel('phone') ?></span>
                            <p><?= $user->phone ?></p>
                        </div>

                    </div>
                </div><!-- /.comment-form -->
            </div>
        </div>
    </div>
</section>
