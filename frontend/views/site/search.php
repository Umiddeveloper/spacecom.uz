<?php
use frontend\widgets\PaginationWidget;
use frontend\widgets\SideBar;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Search') ;

?>

<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"><?= Yii::t('app','Home') ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Yii::t('app', 'SEARCH') ?></li>
                        </ol>
                    </nav>
                    <h3 class="title"><?= Yii::t('app', 'SEARCH') ?>:  <?= $search ?> </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== PAGE TITLE PART ENDS ======-->

<!--====== NEWS PART START ======-->

<div class="news-area news-posts-area pt-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row justify-content">
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemOptions' => [
                            'tag' => false,
                        ],
                        'layout' => "{items}",
                        'itemView' => '_item',
                        'options' => ['tag' => false, 'id' => false],
                        'pager' => [
                            'options' => [
                                'class' => 'pagination'
                            ],
                            'nextPageLabel' => 'Next',
                            'linkOptions' => ['class' => 'page-link'],
                            'firstPageCssClass' => 'page-link',
                            'lastPageCssClass' => 'page-link',
                            'prevPageLabel' => 'Previous',
                            'disabledListItemSubTagOptions' => ['tag' => 'a'],
                            'disabledPageCssClass' => '',
                            'prevPageCssClass' => 'text-light',
                            'nextPageCssClass' => 'text-light',
                        ]
                    ])
                    ?>
                </div>
                <ul class="pagination pagination-md justify-content-center ">
                    <div class="pagination-wrapper">

                    </div>
                </ul>

            </div>
            <div class="col-lg-4">
                <?= SideBar::widget(['lastItems' => $lastItems]); ?>
            </div><!-- /.col-lg-4 -->
        </div>

    </div>
</div>

<!--====== NEWS PART ENDS ======-->

