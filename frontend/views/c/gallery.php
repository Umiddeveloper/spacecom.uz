<?php

use afzalroq\cms\entities\Entities;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = mb_strtoupper($item->getText1());

?>
<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?= Yii::t('app', 'Home') ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                        href="<?= $entity->link ?>"><?= $entity->name ?></a></li>
                        </ol>
                    </nav>
                    <h3 class="title"><?= $item->getText1() ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section style="padding-top: 80px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;"
         class="wa_started_wrapper relative wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <a class="main-btn" href="/e/photo-gallery"><?= Yii::t('app', 'Photo gallery') ?></a>
        <div class="row">
            <div class="col-12">
                <div id="lightgallery">
                    <?php foreach ($item->photos as $photo): ?>
                        <a href="<?= $photo->getPhoto('1024', '800', 'scaleResize', 'transparent', 'center', 'center') ?>">
                            <img src="<?= $photo->getPhoto('370', '280', 'zoomCrop', 'transparent', 'center', 'center') ?>"/>
                        </a>
                    <?php endforeach; ?>
                    <br>
                </div>
                <?php if ($entity->use_comments > Entities::COMMENT_OFF || $entity->use_votes > Entities::COMMENT_OFF): ?>
                    <div class="comment-one">
                        <h3 class="comment-one__block-title">
                            <?php if ($item->comments_count > 0 || $item->avarage_voting > 0): ?>
                                <?= ($entity->use_comments > Entities::COMMENT_OFF) ? Yii::t('app', '{count} Comments', ['count' => $item->comments_count]) : ''?> /
                                <?= ($entity->use_votes > Entities::COMMENT_OFF) ? Yii::t('app', '{vote} Vote', ['vote' => $item->avarage_voting]): ''?>
                            <?php endif ?>
                        </h3>

                        <?php foreach ($comments as $single_comment): ?>
                            <div class="comment-one__single">
                                <div class="comment-one__content">
                                    <h3><?= $single_comment->username ?>
                                        <span class="comment-one__date"><?= Yii::$app->formatter->asDateTime($single_comment->created_at, 'php:j F, Y') ?></span>
                                    </h3>
                                    <p><?= $single_comment->text ?></p>
                                </div>
                                <div class="blog-btn">
                                    <?php if($single_comment->vote) :?>
                                        <p>
                                        <fieldset class="rating">
                                            <input type="radio" disabled id="star5" <?=$single_comment->vote == 5 ? 'checked' : '' ?> name="rating" value="5"/>
                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" disabled id="star4" <?=$single_comment->vote == 4 ? 'checked' : '' ?> name="rating" value="4"/>
                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" disabled id="star3" <?=$single_comment->vote == 3 ? 'checked' : '' ?> name="rating" value="3"/>
                                            <label class="full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" disabled id="star2" <?=$single_comment->vote == 2 ? 'checked' : '' ?> name="rating" value="2"/>
                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" disabled id="star1" <?=$single_comment->vote == 1 ? 'checked' : '' ?> name="rating" value="1"/>
                                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                        </fieldset>
                                        </p>
                                    <?php endif;?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="comment-form">
                        <h3 class="comment-one__block-title"><?= Yii::t('app', 'Leave a Comment') ?></h3>
                        <?php if (!$entity->comment_without_login): ?>
                            <?php if (Yii::$app->user->isGuest): ?>
                                <div class="comment-one__single">
                                    <div class="comment-one__content">
                                        <p>
                                            <?= Yii::t('app', 'to leave a comment') ?>
                                            <a href="<?= Url::to('/site/login') ?>"> <?= Yii::t('app', 'Login') ?></a>
                                            <?= Yii::t('app', 'or') ?>
                                            <a href="<?= Url::to('/site/signup') ?>"> <?= Yii::t('app', 'Signup') ?></a>
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php $form = ActiveForm::begin(['id' => 'create-comment-form', 'options' => ['class' => 'contact-one__form']]); ?>
                                <div class="row">
                                    <?php if ($entity->use_votes > Entities::COMMENT_OFF): ?>
                                        <div class="col-lg-12">
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="Comments[vote]" value="5"/><label
                                                        class="full" for="star5" title="Awesome - 5 stars"></label>

                                                <input type="radio" id="star4" name="Comments[vote]" value="4"/><label
                                                        class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                <input type="radio" id="star3" name="Comments[vote]" value="3"/><label
                                                        class="full" for="star3" title="Meh - 3 stars"></label>

                                                <input type="radio" id="star2" name="Comments[vote]" value="2"/><label
                                                        class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                                <input type="radio" id="star1" name="Comments[vote]" value="1"/><label
                                                        class="full" for="star1"
                                                        title="Sucks big time - 1 star"></label>

                                            </fieldset>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <?= $form->field($comment, 'text')->textarea(['placeholder' => Yii::t('app', ''), 'class' => '', 'rows' => 8, 'cols' => 30])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?= $form->field($comment, 'reCaptcha')->widget(ReCaptcha2::class,
                                                [
                                                    'options' => ['class' => 'form-control mb-30']
                                                ]
                                            )->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <div class="input-box">
                                            <?= Html::submitButton(Yii::t('app', 'Submit Comment'), ['class' => 'main-btn']) ?>
                                        </div>
                                    </div>
                                </div>
                                <?= $form->field($comment, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                                <?= $form->field($comment, 'username')->hiddenInput(['value' => Yii::$app->user->identity->full_name])->label(false) ?>
                                <?= Html::hiddenInput('slug', $entity->slug) ?>
                                <?= Html::hiddenInput('item_id', $item->id) ?>
                                <?php ActiveForm::end(); ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if (Yii::$app->user->isGuest): ?>
                                <?php $form = ActiveForm::begin(['id' => 'create-comment-form', 'options' => ['class' => 'contact-one__form']]); ?>
                                <div class="row">

                                    <?php if ($entity->use_votes > Entities::COMMENT_OFF): ?>
                                        <div class="col-lg-12">
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="Comments[vote]" value="5"/><label
                                                        class="full" for="star5" title="Awesome - 5 stars"></label>

                                                <input type="radio" id="star4" name="Comments[vote]" value="4"/><label
                                                        class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                <input type="radio" id="star3" name="Comments[vote]" value="3"/><label
                                                        class="full" for="star3" title="Meh - 3 stars"></label>

                                                <input type="radio" id="star2" name="Comments[vote]" value="2"/><label
                                                        class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                                <input type="radio" id="star1" name="Comments[vote]" value="1"/><label
                                                        class="full" for="star1"
                                                        title="Sucks big time - 1 star"></label>

                                            </fieldset>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <?= $form->field($comment, 'username')->textInput(['class' => '', 'placeholder' => Yii::t('app', 'Full Name')])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <?= $form->field($comment, 'text')->textarea(['placeholder' => Yii::t('app', 'Comment Text'), 'class' => '', 'rows' => 8, 'cols' => 30])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?= $form->field($comment, 'reCaptcha')->widget(ReCaptcha2::class,
                                                [
                                                    'options' => ['class' => 'form-control mb-30']
                                                ]
                                            )->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <div class="input-box">
                                            <?= Html::submitButton(Yii::t('app', 'Submit Comment'), ['class' => 'main-btn']) ?>
                                        </div>
                                    </div>
                                </div>
                                <?= Html::hiddenInput('slug', $entity->slug) ?>
                                <?= Html::hiddenInput('item_id', $item->id) ?>
                                <?php ActiveForm::end(); ?>
                            <?php else: ?>
                                <?php $form = ActiveForm::begin(['id' => 'create-comment-form', 'options' => ['class' => 'contact-one__form']]); ?>
                                <div class="row">
                                    <?php if ($entity->use_votes > Entities::COMMENT_OFF): ?>
                                        <div class="col-lg-12">
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="Comments[vote]" value="5"/><label
                                                        class="full" for="star5" title="Awesome - 5 stars"></label>

                                                <input type="radio" id="star4" name="Comments[vote]" value="4"/><label
                                                        class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                <input type="radio" id="star3" name="Comments[vote]" value="3"/><label
                                                        class="full" for="star3" title="Meh - 3 stars"></label>

                                                <input type="radio" id="star2" name="Comments[vote]" value="2"/><label
                                                        class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                                <input type="radio" id="star1" name="Comments[vote]" value="1"/><label
                                                        class="full" for="star1"
                                                        title="Sucks big time - 1 star"></label>

                                            </fieldset>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <?= $form->field($comment, 'text')->textarea(['placeholder' => Yii::t('app', ''), 'class' => '', 'rows' => 8, 'cols' => 30])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <?= $form->field($comment, 'reCaptcha')->widget(ReCaptcha2::class,
                                                [
                                                    'options' => ['class' => 'form-control mb-30']
                                                ]
                                            )->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <div class="input-box">
                                            <?= Html::submitButton(Yii::t('app', 'Submit Comment'), ['class' => 'main-btn']) ?>
                                        </div>
                                    </div>
                                </div>
                                <?= $form->field($comment, 'user_id')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>
                                <?= $form->field($comment, 'username')->hiddenInput(['value' => Yii::$app->user->identity->full_name])->label(false) ?>
                                <?= Html::hiddenInput('slug', $entity->slug) ?>
                                <?= Html::hiddenInput('item_id', $item->id) ?>
                                <?php ActiveForm::end(); ?>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
