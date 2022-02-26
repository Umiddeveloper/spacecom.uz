<?php

/* @var $items afzalroq\cms\entities\front\Items[] */


use ereminmdev\yii2\infinite_scroll\InfiniteScroll;
use frontend\widgets\SideBar;
use nirvana\infinitescroll\InfiniteScrollPager;
use yii\helpers\StringHelper;
use yii\web\JsExpression;
use yii\widgets\ListView;

$this->title = mb_strtoupper($entity->name);
?>

<!--====== PAGE TITLE PART START ======-->

<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container"
    ">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title-item text-center">
                <h3 class="title"><?= $entity->name ?></h3>
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
                <?= ListView::widget([
                    'dataProvider' => $articles,
                    'options' => [
                        'class' => 'row justify-content list-view'
                    ],
                    'itemOptions' => ['class' => 'item col-lg-6 col-md-6 col-sm-9'],
                    'summary' => '',
                    'itemView' => function ($model, $i, $index) use ($entity) {
                        return $this->render('_items', ['item' => $model, 'entity' => $entity]);
                    },
                    'pager' => ['class' => InfiniteScroll::class]
                ]); ?>
            </div>
            <div class="col-lg-4">
                <?= SideBar::widget(); ?>
            </div><!-- /.col-lg-4 -->
        </div>

    </div>
</div>
<?php
$this->registerJs(<<<JS
    $(document).on('click', '#sample_filter', function (event) {
        $('.list-view').load('sample_url', function () {
            
            //reinitialize plugin after load success
            jQuery.ias().reinitialize();
        });
        event.preventDefault();
    });
JS
)
?>
