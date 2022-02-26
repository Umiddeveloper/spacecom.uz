<?php


/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $entity afzalroq\cms\entities\Entities */
/* @var $item afzalroq\cms\entities\front\Item */
/* @var $comment afzalroq\cms\entities\front\Comments */

/* @var $comments afzalroq\cms\entities\front\Comments[] */

use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\unit\Unit;
use frontend\widgets\SideBar;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = mb_strtoupper($entity->name);
$item->registerMetaTags();

if (($item->entity->text_1 > 0 && empty($item->getText1()))) {
    return Yii::$app->response->redirect(['/site/index']);
}
?>
<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?= Yii::t('app', 'Home') ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="<?= $title->link ?>"><?= $title->name ?></a></li>
                        </ol>
                    </nav>
                    <h3 class="title"><?= $item->getText1() ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== PAGE TITLE PART ENDS ======-->

<!--====== PAGE TITLE PART ENDS ======-->

<section class="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details__main">
                    <?php if (!empty($item->file_1_0)): ?>
                        <div class="blog-details__image">
                            <img src="<?= $item->getPhoto1('770', '473', 'resize', 'transparent', 'center', 'center'); ?>" alt="thumb">
                            <span><span><?php if ($entity->slug === 'news') {
                                        Yii::$app->formatter->asDateTime($item->getDate(), 'php:j F, Y');
                                    } ?></span><span class="pl-10 pr-10"></span>    <?= Yii::t('app', '{count} Comments', ['count' => (int)$item->comments_count]) ?></span>
                        </div><!-- /.blog-details__image -->
                    <?php endif; ?>
                    <div class="blog-details__content">
                        <h3><?= $item->getText1() ?></h3>
                        <p><?= $item->getText2() ?></p>
                    </div><!-- /.blog-details__content -->
                    <div class="blog-details__meta">
                        <div class="blog-details__tags">

                            <?php if (isset($item->options['tags'])):
                                echo "<span>" . Yii::t('app', 'Tags') . ": </span>";
                                foreach ($tags as $key => $tag): ?>
                                    <a href="<?= $tag->link ?>"><?= $tag->getName() ?> </a>
                                <?php endforeach; endif; ?>

                        </div><!-- /.blog-details__tags -->
                        <div class="blog-details__share">
                            <ul>
                                <li><a target="_blank" rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?= Yii::$app->getUrlManager()->createAbsoluteUrl($item->link) ?>"><i class="fa fa-facebook-square"></i></a></li>
                                <li><a target="_blank" rel="nofollow"  href="https://t.me/share/url?url=<?= Yii::$app->getUrlManager()->createAbsoluteUrl($item->link) ?>&text=<?= $this->title ?>"><i class="fa fa-telegram"></i></a></li>
                                <li><a target="_blank" rel="nofollow" href="https://twitter.com/share?url=<?= Yii::$app->getUrlManager()->createAbsoluteUrl($item->link) ?>&text=<?= $this->title ?>&hashtags=<?= $this->title ?>spacecomuzb"><i class="fa fa-twitter"> </i></a>
                                </li>
                                <li><a target="_blank" rel="nofollow" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= Yii::$app->getUrlManager()->createAbsoluteUrl($item->link) ?>&text=<?= $this->title ?>"><i class="fa fa-linkedin"></i></a></li>

                            </ul>
                        </div><!-- /.blog-details__share -->
                    </div><!-- /.blog-details__meta -->
                </div><!-- /.blog-details__main -->

                <!--                comment section-->
                <?php if ($entity->use_comments > Entities::COMMENT_OFF || $entity->use_votes > Entities::COMMENT_OFF): ?>
                    <div class="comment-one">
                        <h3 class="comment-one__block-title">
                            <?php if ($item->comments_count > 0 || $item->avarage_voting > 0): ?>
                                <?= Yii::t('app', '{count} Comments', ['count' => $item->comments_count]) ?> /
                                <?= Yii::t('app', '{vote} Vote', ['vote' => $item->avarage_voting]) ?>
                            <?php endif ?>
                        </h3>

                        <?php foreach ($comments as $single_comment): ?>
                            <div class="comment-one__single">
                                <div class="comment-one__content">
                                    <h3><?= $single_comment->username ?> <span class="comment-one__date"><?= Yii::$app->formatter->asDateTime($single_comment->created_at, 'php:j F, Y') ?></span></h3>
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
                            <?php if(Yii::$app->user->isGuest): ?>
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
            <div class="col-lg-4">
                <?= SideBar::widget() ?>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.blog-details -->
