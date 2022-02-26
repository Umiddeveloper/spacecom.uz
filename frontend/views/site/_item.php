<?php

use yii\helpers\StringHelper;
?>
<div class="col-lg-6 col-md-6 col-sm-9">
        <div class="news-item ">
            <div class="news-thumb">
                <img src="<?= $model->getPhoto1('370', '280', 'zoomCrop', 'transparent', 'center', 'center'); ?>" alt="news">
            </div>
            <div class="news-content text-center">
                <a href="<?= $model->link ?>"><?= StringHelper::truncate(strip_tags($model->getText1()), 50, '...'); ?></a>
                <div class="date">
                    <span>
                        <span><?= Yii::$app->formatter->asDateTime($model->date, 'php:j F, Y'); ?></span>
                        <span class="pl-10 pr-10">   -</span>
                        <?= Yii::t('app', '{count} Comments', ['count' => (int)$model->comments_count]) ?>
                    </span>
                    </span>
                </div>
            </div>
        </div>
    </div>