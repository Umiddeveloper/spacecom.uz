<?php

use afzalroq\cms\entities\front\Menu;
use afzalroq\cms\entities\unit\Unit;
use frontend\widgets\LanguagesWidget;
use yii\helpers\Html;
use yii\helpers\Url;

$menuTree = Menu::getMenu('main');
?>

<div class="preloader">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>


<div class="searchBox">
    <div class="searchBoxContainer">
        <a href="javascript:void(0);" class="closeBtn">
            <svg viewBox="0 0 413.348 413.348" xmlns="http://www.w3.org/2000/svg">
                <path d="m413.348 24.354-24.354-24.354-182.32 182.32-182.32-182.32-24.354 24.354 182.32 182.32-182.32 182.32 24.354 24.354 182.32-182.32 182.32 182.32 24.354-24.354-182.32-182.32z"></path>
            </svg>
        </a>
        <form id="SearchForm" method="get" action="<?= Url::to(['site/search']) ?>">
            <div class="search_bar_inner">
                <input type="text" name="q" placeholder="<?= Yii::t('app', 'Search here...') ?>">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>


<div class="off_canvars_overlay"></div>

<div class="offcanvas_menu">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="fa fa-times"></i></a>
                    </div>
                    <div class="header-social">
                        <ul class="text-center">
                            <li><a href="<?= Unit::get('facebook'); ?>"><i class="fa fa-facebook-f"></i></a></li>
                            <li><a href="<?= Unit::get('telegram'); ?>"><i class="fa fa-telegram"></i></a></li>
                            <li><a href="<?= Unit::get('instagram'); ?>"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="<?= Unit::get('youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active" data-type="toggler" data-target="site-nav__1"><span class="menu-expand"><i class="fa fa-angle-down"></i></span>
                                <a href="#"><?= \Yii::$app->params['cms']['languages'][\Yii::$app->params['l'][\Yii::$app->language]] ?></a>
                                <ul class="sub-menu" id="site-nav__1" style="display: none;">
                                    <?= LanguagesWidget::widget(['mobile' => true]) ?>
                                </ul>
                            </li>
                            <?php foreach ($menuTree as $i => $menu): ?>
                                <?php if (empty($menu['children'])): ?>
                                    <li class="menu-item-has-children active">
                                        <a href="<?= $menu['link'] ?>"><?= $menu['content'] ?></a>
                                    </li>
                                <?php else: ?>
                                    <li class="menu-item-has-children active" data-type="toggler" data-target="site-nav__<?= $i ?>">
                                        <a href="#"><?= $menu['content'] ?></a>
                                        <ul class="sub-menu" id="site-nav__<?= $i ?>">
                                            <?php foreach ($menu['children'] as $child): ?>
                                                <li><a href="<?= $child['link'] ?>"><?= $child['content'] ?> </a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="mailto:<?= Unit::get('email') ?>"><i class="fa fa-envelope-o"></i><?= Unit::get('email') ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<header class="header-area header-2-area">
    <div class="header-top-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-top-item">
                        <div class="social"></div>
                        <div class="header-info">
                            <ul>
                                <li><a href="#"><i class="flaticon-call"></i> <?= Unit::get('tell-number'); ?></a></li>
                                <li><a href="#"><i class="flaticon-email-2"></i><?= Unit::get('email'); ?></a></li>
                                <li><a href="<?= Unit::get('facebook'); ?>"><i style="color: #ccc;" class="fa fa-facebook-f"></i></a></li>
                                <li><a href="<?= Unit::get('telegram'); ?>"><i style="color: #ccc;" class="fa fa-telegram"></i></a></li>
                                <li><a href="<?= Unit::get('instagram'); ?>"><i style="color: #ccc;"  class="fa fa-instagram"></i></a></li>
                                <li><a href="<?= Unit::get('youtube'); ?>"><i style="color: #ccc;" class="fa fa-youtube"></i></a></li>
                                <li><a href="<?= Unit::get('twitter'); ?>"><i style="color: #ccc;" class="fa fa-twitter"></i></a></li>
                                <li><a href="<?= Unit::get('linkedin'); ?>"><i style="color: #ccc;" class="fa fa-linkedin"></i></a></li>

                                <li><a id="header_inner-search" class="searchBtn" href="javascript:void(0);"><i style="color: #ccc;" class="fa fa-search"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-header-item d-flex justify-content-between align-items-center">
                        <div class="main-header-menus  d-flex">
                            <div class="header-logo">
                                <a href="/"><img src="/images/logo-2.png" alt="logo"></a>
                            </div>
                            <div class="header-menu d-none d-lg-block">
                                <ul>
                                    <?php foreach ($menuTree as $i => $menu): ?>
                                        <?php if (empty($menu['children'])): ?>
                                            <li class="menu-item-has-children active">
                                                <a href="<?= $menu['link'] ?>"><?= $menu['content'] ?></a>
                                            </li>
                                        <?php else: ?>
                                            <li class="menu-item-has-children active" data-type="toggler" data-target="site-nav__<?= $i ?>">
                                                <a href="#"><?= $menu['content'] ?></a>
                                                <ul class="sub-menu" id="site-nav__<?= $i ?>">
                                                    <?php foreach ($menu['children'] as $child): ?>
                                                        <li><a href="<?= $child['link'] ?>"><?= $child['content'] ?> </a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?= Url::to('/faq/index') ?>"><?= Yii::t('app', 'FAQ') ?></a>
                                    </li>
                                </ul>
                                <div class="header-search">
                                    <a href="javascript:void(0);" class="searchBtn"><i class="flaticon-search"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="header-laguage d-flex align-items-center">
                            <select name="forma" onchange="location = this.value;">
                                <option value=""><?= Yii::$app->params['cms']['languages'][Yii::$app->params['cms']['languageIds'][Yii::$app->language]] ?> </option>
                                <?= LanguagesWidget::widget() ?>
                            </select>
                            <div class="toggle-btn ml-30 canvas_open">
                                <i class="fa fa-bars"></i>
                            </div>
                        </div>

                        <div class="header-laguage d-flex align-items-center">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <select style="display: none;" onclick="location = this.value;">
                                    <option value="<?= Url::to('/site/signup') ?>"><?= Yii::t('app', 'Signup') ?></option>
                                    <option value="<?= Url::to('/site/login') ?>"><?= Yii::t('app', 'Login') ?></option>
                                </select>
                                <div class="nice-select" tabindex="0">
                                    <span class="current"><i class="fa fa-user"></i></span>
                                    <ul class="list">
                                        <li data-value="1" class="option <!--selected focus-->">
                                            <a href="<?= Url::to('/site/signup') ?>"> <?= Yii::t('app', 'Signup') ?></a>
                                        </li>
                                        <li data-value="2" class="option">
                                            <a href="<?= Url::to('/site/login') ?>"> <?= Yii::t('app', 'Login') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            <?php else: ?>
                                <select style="display: none;" onclick="location = this.value;">
                                    <option value="<?= Url::to('/profile') ?>"><?= Yii::t('app', 'Profile') ?></option>
                                    <option value="<?= Url::to('/site/logout') ?>"><?= Yii::t('app', 'Sign Out') ?></option>
                                </select>
                                <div class="nice-select" tabindex="0">
                                    <span class="current"><i class="fa fa-user"></i></span>
                                    <ul class="list">
                                        <li data-value="1" class="option <!--selected focus-->">
                                            <a href="<?= Url::to('/profile') ?>" class="btn btn-link btn-sm"> <?= Yii::t('app', 'Profile') ?></a>
                                        </li>
                                        <li data-value="2" class="option">
                                            <?= Html::a(
                                                Yii::t('app', 'Sign out'),
                                                ['/site/logout'],
                                                [
                                                    'data-method' => 'post',
                                                    'class' => 'btn btn-link btn-sm',
                                                    'data' => [
                                                        'confirm' => Yii::t('app', Yii::t('app', 'Are you sure you want to logout?')),
                                                        'method' => 'post',
                                                    ],
                                                ]
                                            ) ?>
                                        </li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
