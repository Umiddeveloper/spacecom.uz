<?php
use yii\widgets\LinkPager;
?>

<ul class="pagination pagination-md justify-content-center ">
    <?= LinkPager::widget([
        'pagination' => $page,
        'options' => [
            'class' => 'pagination'
        ],
        'nextPageLabel' =>  Yii::t('app','Next') ,
        'linkOptions' => ['class' => 'page-link'],
        'firstPageCssClass' => 'page-link',
        'lastPageCssClass' => 'page-link',
        'prevPageLabel' => Yii::t('app','Previous') ,
        'disabledListItemSubTagOptions' => ['tag' => 'a'],
        'disabledPageCssClass' => '',
        'prevPageCssClass' => 'text-light',
        'nextPageCssClass' => 'text-light',
    ])?>
</ul>
