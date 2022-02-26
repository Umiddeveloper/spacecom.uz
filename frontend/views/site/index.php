<?php

use afzalroq\cms\entities\unit\Unit;
use yii\helpers\StringHelper;

$this->title = Yii::t('app', 'Home');
?>
<!--====== BANNER PART START ======-->
<section class="banner-slide">
    <?php  foreach ($sliders as $slider): ?>
        <div class="banner-area banner-2-area bg_cover d-flex align-items-center"
             style="background-image: url(<?= $slider->getPhoto1('1351', '830', 'zoomCrop', 'transparent', 'center', 'center'); ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="banner-content text-lrft">
                            <h3 data-animation="fadeInDown" data-delay="1s" class="title"><?= StringHelper::truncate(strip_tags($slider->getText1()), 50, '...'); ?></h3>
                            <p data-animation="fadeInLeft" data-delay=".1s"><?= $slider->getText2() ?></p>
                            <a data-animation="fadeInUp" data-delay="1s" class="main-btn" href="<?= $slider->getText3() ?>"><?= Yii::t('app','Discover more')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-shadow">
                <img src="/images/banner-shadow.png" alt="shadow">
            </div>
        </div>
    <?php endforeach; ?>
</section
    <!--====== BANNER PART ENDS ======-->
<?php if(isset($main_banner)): ?>
    <section class="anouns pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="<?=$main_banner->getText2()?>"><img class="image_anouns" src="/images/spacecomanouns.gif" alt=""></a>
                </div>
                <div class="col-lg-6">
                    <p class="anouns_text"><a href="<?=$main_banner->getText2()?>">
                            <?=$main_banner->getText1()?>
                        </a></p>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!--====== NANO PART START ======-->

<section class="nano-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="nano-item">
                    <span><?= Unit::get('main-page-card1-text1'); ?></span>
                    <a href="<?= Unit::get('main-page-card1-link'); ?>"><h4
                                class="title"><?= Unit::get('main-page-card1-text2'); ?></h4></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="nano-item active">
                    <span><?= Unit::get('main-page-card2-text1'); ?></span>
                    <a href="<?= Unit::get('main-page-card2-link'); ?>"><h4
                                class="title"><?= Unit::get('main-page-card2-text2'); ?></h4></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="nano-item">
                    <span><?= Unit::get('main-page-card3-text1'); ?></span>
                    <a href="<?= Unit::get('main-page-card3-link'); ?>"><h4
                                class="title"><?= Unit::get('main-page-card3-text2'); ?></h4></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== NANO PART ENDS ======-->

<!--====== ABOUT PART START ======-->

<section class="solution-2-area pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="solution-thumb animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="0ms">
                    <img src="<?= Unit::get('about-card-pictures'); ?>" alt="thumb">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="solution-content pl-35">
                    <h3 class="title"><?= Unit::get('about-card-text1'); ?></h3>
                    <p><?= Unit::get('about-card-text2'); ?></p>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="solution-item mt-30">
                                <h4><i class="fa fa-angle-right"></i><?= Unit::get('about-card-text3'); ?></h4>
                                <p><?= Unit::get('about-card-text-4'); ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="solution-item mt-30">
                                <h4><i class="fa fa-angle-right"></i><?= Unit::get('about-card-text-5'); ?></h4>
                                <p><?= Unit::get('about-card-text-6'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="solution-btns mt-60 d-block d-sm-flex  align-items-center">
                        <a class="main-btn"
                           href="<?= Unit::get('about-card-button-link'); ?>"><?= Unit::get('about-card-button-text'); ?></a>
                        <div class="play">
                            <a href="<?= Unit::get('about-card-vidio-link'); ?>"
                               class="d-flex align-items-center video-popup">
                                <div class="thumb">
                                    <img src="<?= Unit::get('about-card-vidio-pictures'); ?>" alt="">
                                </div>
                                <span><?= Unit::get('about-card-vidio-text'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shape-1">
        <img src="/images/shape/shape-7.png" alt="">
    </div>
    <div class="shape-2 animated wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="0ms">
        <img src="/images/shape/shape-8.png" alt="">
    </div>
</section>

<!--====== ABOUT PART ENDS ======-->
<!--====== VIDEO PART START ======-->
<section class="video-area bg_cover pt-150 pb-115"
         style="background-image: url(<?= Unit::get('main-page-video-pictures'); ?>);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="video-item text-center">
                    <a class="video-popup" href="<?= Unit::get('main-page-link'); ?>"><i class="fa fa-play"></i></a>
                    <h3 class="title"><?= Unit::get('main-page-video-text'); ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="shape-1">
        <img src="/images/shape/shape-2.png" alt="">
    </div>
    <div class="shape-2">
        <img src="/images/shape/shape-3.png" alt="">
    </div>
</section>
<!--====== MISSION PART ENDS ======-->

<!--====== NEWS PART START ======-->

<section class="news-area news-3-area pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="news-title d-block d-md-flex justify-content-between align-items-center mb-20">
                    <h3 class="title"><?= Yii::t('app', 'News & Articles') ?></h3>
                    <a class="main-btn" href="/e/news"><?= Yii::t('app', 'View All posts') ?></a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <?php foreach ($news as $newsItem): ?>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="news-item mt-30 animated wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="news-thumb">
                            <a href="<?= $newsItem->link ?>"><img
                                        src="<?= $newsItem->getPhoto1('370', '280', 'zoomCrop', 'transparent', 'center', 'center'); ?>"
                                        alt="news"></a>
                        </div>
                        <div class="news-content text-center">
                            <a href="<?= $newsItem->link ?>"><?= StringHelper::truncate(strip_tags($newsItem->getText1()), 50, '...'); ?></a>
                            <div class="date">
                                <span><span><?= Yii::$app->formatter->asDateTime($newsItem->getDate(), 'php:j F, Y'); ?></span><span
                                            class="pl-10 pr-10">   -</span>
                                            <?= Yii::t('app', '{count} Comments', ['count' => (int)$newsItem->comments_count]) ?>
                                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="shape">
        <img src="/images/shape/shape-11.png" alt="">
    </div>
</section>

<!--====== NEWS PART ENDS ======-->


<!--====== BRAND PART START ======-->

<div class="brand-area brand-3-area pb-120">
    <div class="container">
        <div class="row brand-active">
            <?php foreach ($partners as $partner): ?>
                <div class="col-lg-3">
                    <div class="brand-item">
                        <a href="<?= $partner->getText1() ?>" target="_blank"><img
                                    src="<?= $partner->getPhoto1('128', '128', 'resize', 'transparent', 'center', 'center'); ?>"
                                    alt="brand"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<section class="gallery_top  pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="news-title d-block d-md-flex justify-content-between align-items-center mb-20">
                    <a class="main-btn" href="/e/photo-gallery"> <?= Yii::t('app', 'All  Photo gallery') ?> </a>
                    <h3 class="title"><?= Yii::t('app', 'Photo gallery') ?></h3>
                </div>
                <div class="row">
                    <?php foreach ($photos as $photo): ?>
                        <div style="padding-bottom: 30px" class="col-4"><a href="<?= $photo->link ?>"><img
                                        src="<?= $photo->getGalleryPhoto('370', '280', 'zoomCrop', 'transparent', 'center', 'center'); ?>"
                                        alt="news"></a>
                            <h3 class="photo_inner-iteam"><a href=""></a><?=$photo->getText1()?></h3></div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!--====== BRAND PART ENDS ======-->
