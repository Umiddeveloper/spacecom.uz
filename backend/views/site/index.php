<?php
use backend\models\Count;
use yii\helpers\Url;
$this->title = Yii::t('app', 'Admin panel')
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/menu/index?slug=main']) ?>">
                        <h4>Main menu</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/menu/index?slug=footer-main']) ?>">
                        <h4>Footer menu  </h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/options/index?slug=category']) ?>">
                        <h4>Categories
                            <mark><?= Count::countOption('category') ?></mark>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/options/index?slug=tags']) ?>">
                        <h4>Tags
                            <mark><?= Count::countOption('tags') ?></mark>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/items/index?slug=pages']) ?>">
                        <h4>Pages
                            <mark><?= Count::countItem('pages') ?></mark>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-font"></i></span>
                <div class="info-box-content">
                    <a href="<?= Url::to(['/cms/items/index?slug=news']) ?>">
                        <h4>News
                            <mark><?= Count::countItem('news') ?></mark>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($notifications)): ?>
<div class="box">
    <div class="box-body">
        <div class="site-index">
            <?php foreach ($notifications as $notification) :?>
                <div class="alert alert-warning alert-dismissible">
<!--                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                    <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                    <?=$notification['notification']['message']?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<?php endif ?>