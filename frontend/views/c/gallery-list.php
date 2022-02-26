<?php

use ereminmdev\yii2\infinite_scroll\InfiniteScroll;
use yii\widgets\ListView;

$this->title = mb_strtoupper($entity->getName());
?>

<div class="page-title-area bg_cover pt-120" style="background-image: url(/images/page-bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-item text-center">
                    <h3 class="title"><?= $entity->name ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section style="padding-top: 80px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;" class="wa_started_wrapper relative wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?= ListView::widget([
                    'dataProvider' => $articles,
                    'options' => [
                        'class' => 'row justify-content list-view'
                    ],
                    'itemOptions' => ['class' => 'item col-lg-4 col-md-4 col-sm-6'],
                    'summary' => '',
                    'itemView' => function ($model, $i, $index) use ($entity) {
                        return $this->render('_photo', ['item' => $model, 'entity' => $entity]);
                    },
                    'pager' => ['class' => InfiniteScroll::class]
                ]); ?>
            </div>
        </div>
    </div>
</section>
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
