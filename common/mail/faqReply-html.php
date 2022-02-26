<?php

use yii\helpers\Html;

?>
<div class="faq-reply">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>text</p>
    <p><?=$faq->answer ?></p>

</div>