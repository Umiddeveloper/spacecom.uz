<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container">

    <div class="site-error text-center">
        <br>
        <h1><?= Html::encode($this->title) ?></h1>
        <br>
        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
           <?= Yii::t('app', 'The above error occurred while the Web server was processing your request') ?>
        </p>
        <br>
        <p>
            <?= Yii::t('app','Please contact us if you think this is a server error. Thank you.'); ?>
        </p>
        <br>
    </div>
</div>