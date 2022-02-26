<?php

use afzalroq\cms\entities\Collections;
use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\front\Items;
use afzalroq\cms\entities\front\Options;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$lastItems = Items::find()->where(['entity_id' => Entities::findOne(['slug' => 'pages'])->id])
    ->andWhere(['!=', 'text_1' . "_" . Yii::$app->params['cms']['languageIds'][Yii::$app->language], ""])
    ->orderBy('date_0 DESC')->limit(3)->all();
$categories = Options::find()->where(['collection_id' => Collections::findOne(['slug' => 'category'])->id])
    ->andWhere(['!=', 'name_' . Yii::$app->params['cms']['languageIds'][Yii::$app->language], ""])
    ->all();
$tags = Options::find()->where(['collection_id' => Collections::findOne(['slug' => 'tags'])->id])
    ->andWhere(['!=', 'name_' . Yii::$app->params['cms']['languageIds'][Yii::$app->language], ""])
    ->all();
?>
<div class="sidebar">
    <div class="sidebar__single sidebar__search">
        <form class="sidebar__search-form" id="SearchForm" method="get" action="<?= Url::to(['site/search']) ?>">
            <input type="text" name="q" placeholder="<?= Yii::t('app', 'Search here...'); ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div><!-- /.sidebar__single -->
    <div class="sidebar__single sidebar__post">
        <h3 class="sidebar__title"><?= Yii::t('app', 'Recent Posts'); ?></h3><!-- /.sidebar__title -->
        <div class="sidebar__post-wrap">
            <?php foreach ($lastItems as $lastItem): ?>
            <div class="sidebar__post__single">
                <div class="sidebar__post-image">
                    <div class="inner-block"><a href="<?= $lastItem->link ?>"><img src="<?= $lastItem->getPhoto1('66', '67', 'resize', 'transparent', 'center', 'center'); ?>" alt="Awesome Image"/>
                        </a></div>
                    <!-- /.inner-block -->
                </div><!-- /.sidebar__post-image -->
                <div class="sidebar__post-content">
                    <h4 class="sidebar__post-title"><a href="<?= $lastItem->link ?>"><?= StringHelper::truncate(strip_tags($lastItem->getText1()), 100, '...'); ?></a></h4>
                    <!-- /.sidebar__post-title -->
                </div><!-- /.sidebar__post-content -->
            </div><!-- /.sidebar__post__single -->
            <?php endforeach; ?>
        </div><!-- /.sidebar__post-wrap -->
    </div><!-- /.sidebar__single -->
    <div class="sidebar__single sidebar__category">
        <h3 class="sidebar__title">Categories</h3><!-- /.sidebar__title -->
        <ul class="sidebar__category-list">
            <?php foreach ($categories as $category): ?>
            <li class="sidebar__category-list-item"><a href="<?= $category->link ?>"><?= $category->getName() ?></a></li>
            <?php endforeach; ?>
        </ul><!-- /.sidebar__category-list -->
    </div><!-- /.sidebar__single -->
    <div class="sidebar__single sidebar__tags">
        <h3 class="sidebar__title">Tags</h3><!-- /.sidebar__title -->
        <ul class="sidebar__tags-list">
            <?php foreach ($tags as $tag): ?>
            <li class="sidebar__tags-list-item"><a href="<?= $tag->link ?>"><?= $tag->getName() ?></a></li>
            <?php endforeach; ?>
        </ul><!-- /.sidebar__category-list -->
    </div><!-- /.sidebar__single -->
</div><!-- /.sidebar -->
