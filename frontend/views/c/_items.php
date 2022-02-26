<?php

use yii\helpers\StringHelper;

?>

<div class="news-item">
    <div class="news-thumb">
        <a href="<?= $item->link ?>"> <img src="<?= $item->getPhoto1('370', '280', 'resize', 'transparent', 'center', 'center'); ?>" alt="news"> </a>
    </div>
    <div class="news-content text-center">
        <a href="<?= $item->link ?>"><?= StringHelper::truncate(strip_tags($item->getText1()), 50, '...'); ?></a>
        <div class="date">
                <span><span><?php if ($entity->slug === 'news') {
                            echo Yii::$app->formatter->asDateTime($item->getDate(), 'php:j F, Y');
                        } ?></span><span class="pl-10 pr-10"> </span>
                    <?= Yii::t('app', '{count} Comments', ['count' => (int)$item->comments_count]) ?></span>
        </div>
    </div>
</div>
