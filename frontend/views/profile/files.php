<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

use yii\helpers\Html;

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
                    <h3 class="title"><?= Yii::t('app', 'Files')?></h3>
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
        <p>
            <?= Html::a(Yii::t('app', 'Edit Profile'), ['edit-profile'], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('app', 'Files'), ['files'], ['class' => 'btn btn-info']) ?>
        </p>
        <br>
        <?= \mihaildev\elfinder\ElFinder::widget(['frameOptions' => ['style' => 'width: 100%; height: 840px; border: 0;']]) ?>
    </div>
</section>
