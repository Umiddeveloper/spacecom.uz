<?php

/* @var $this View */

/* @var $content string */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\widgets\FooterWidget;
use frontend\widgets\Header;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php if (Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index'): ?>
        <meta name="description" content="Space Communication Uzbekistan | Spacecom.uz">
    <?php endif ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->head() ?>
    <!--====== Title ======-->
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Yii::$app->name . ' - ' . Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/css/lightgallery.min.css"
          integrity="sha512-KQBpYvtKcj7ytImR2yOZq7MV+U1eqUS3E6hyf43a5b4Amw4+8XZ7ReNDOCbgjf8wK+L/v5aOA4dWIsEZqZnSwQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/css/lg-zoom.min.css"
          integrity="sha512-SGo05yQXwPFKXE+GtWCn7J4OZQBaQIakZSxQSqUyVWqO0TAv3gaF/Vox1FmG4IyXJWDwu/lXzXqPOnfX1va0+A==" crossorigin="anonymous"
          referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/css/lg-thumbnail.min.css"
          integrity="sha512-wHHBD+hSImJWcX192FT77uzFT4pVJDZ5sTiVYE3cArMtIix9lycXS0lvuLwRVyyFQO4pTj7MKxSuFKFMVzjK2w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/css/lightgallery-bundle.min.css"
          integrity="sha512-VZt+fhEFKR7bhZs7SVizfZIK9T5xFcy0cpFkst2nAM/Wr/3DTj3zj0mogxTvLd2wWVjWgdjr5qPnYXw2i1w1WQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>
<body class="stretched">
<?php $this->beginBody() ?>

<?= Header::widget() ?>

<?= Breadcrumbs::widget([
    'links' => $this->params['breadcrumbs'] ?? [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>

<?= FooterWidget::widget() ?>

<?php $this->endBody() ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/lightgallery.umd.min.js"
        integrity="sha512-l69eSOBGvDFhh5Q2RKrPVMTDEH96F3ePijw3Rzzph1C3e1jEk+Zq2LNgB1i6KmD6XaOWZQ89eY5V0cfF6M7RaA==" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/lightgallery.min.js"
        integrity="sha512-wU4TPjLb8ZyiF0P/cAMcBJ0/ZYOZuQLjX5hUV6tTstUnyhEJ4XVc+UPHFQxpxulNOq2gvWNiuHz/om+0q6BClw==" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/plugins/thumbnail/lg-thumbnail.umd.min.js"
        integrity="sha512-Y32mW3X2XL9mubA7TIL/5VJclC/pgKqa5WBvWNdELiI4iDqoyeudt44jZQ17D0XR01exKB98OSTUjN/3lqm/MQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.2.0-beta.0/plugins/zoom/lg-zoom.umd.min.js"
        integrity="sha512-zaTknCWaTCRvX56GAnDAoU9RPUUnWhLVZVWtRsCMNp1cZp9CC00G5zBKf0SEnYsr0FIPzPTdC3JvXw6MW8YtYw==" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script>
    lightGallery(document.getElementById('lightgallery'), {
        plugins: [lgZoom, lgThumbnail],
        speed: 500,
        animateThumb: false,
        zoomFromOrigin: false,
        allowMediaOverlap: true,
        toggleThumb: true,
    });
</script>

</body>
</html>
<?php $this->endPage() ?>
