<?php use afzalroq\cms\entities\Collections;
use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\front\Items;
use afzalroq\cms\entities\front\Menu;
use afzalroq\cms\entities\front\Options;
use afzalroq\cms\entities\unit\Unit;
use yii\helpers\StringHelper;

$categories = Options::find()
    ->where(['collection_id' => Collections::findOne(['slug' => 'category'])->id])
    ->andWhere(['!=', 'name_' . Yii::$app->params['cms']['languageIds'][Yii::$app->language], ""])
    ->all();

$menuTree = Menu::getMenu('footer-main');
$countMenu = count($menuTree);
$lastNews = Items::find()
    ->where(['entity_id' => Entities::findOne(['slug' => 'news'])->id])
    ->andWhere(['!=', 'text_1' . "_" . Yii::$app->params['cms']['languageIds'][Yii::$app->language], ""])
    ->orderBy('date_0 DESC')->limit(2)->all();
?>

<footer class="footer-area">
    <div class="container">
        <div class="footer-main">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget mt-30">
                        <div class="footer-title ">
                            <h4 class="title"><?= Yii::t('app', 'Contact') ?></h4>
                        </div>
                        <div class="footer-about-content">
                            <div class="email">
                                <a href="mailto:<?= Unit::get('email'); ?>"><?= Unit::get('email'); ?></a>
                            </div>
                            <div class="call">
                                <a href="tel:<?= Unit::get('tell-number'); ?>"><?= Unit::get('tell-number'); ?></a>
                            </div>
                            <div class="social">
                                <ul>
                                    <li><a href="<?= Unit::get('facebook'); ?>"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="<?= Unit::get('telegram'); ?>"><i class="fa fa-telegram"></i></a></li>
                                    <li><a href="<?= Unit::get('instagram'); ?>"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                                <br>
                                <ul>
                                    <li><a href="<?= Unit::get('youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="<?= Unit::get('twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="<?= Unit::get('linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>

                                </ul>
                                <br>
                                <ul>
                                <!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=84632179&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/84632179/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="84632179" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(84632179, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        trackHash:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/84632179" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mt-30 ml-30">
                        <div class="footer-title pb-20">
                            <h4 class="title"><?= Yii::t('app', 'Menu') ?></h4>
                        </div>
                        <div class="footer-about-list d-flex">
                            <ul class="mr-70">
                                <?php foreach ($menuTree as $i => $menu): ?>
                                    <?php if (empty($menu['children'])): ?>
                                        <li><a href="<?= $menu['link'] ?>"><?= $menu['content'] ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mt-30 ml-30">
                        <div class="footer-title pb-20">
                            <h4 class="title"><?= Yii::t('app', 'Categories') ?></h4>
                        </div>
                        <div class="footer-about-list d-flex">
                            <ul class="mr-70">
                                <?php foreach ($categories as $category): ?>
                                    <li><a href="<?= $category->link ?>"><i class="fa fa-angle-right"></i><?= $category->getName() ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-7">
                    <div class="footer-widget footer-news mt-30">
                        <div class="footer-title pb-40">
                            <h4 class="title"><?= Yii::t('app', 'Latest News') ?></h4>
                        </div>
                        <div class="footer-news-content">
                            <?php foreach ($lastNews as $news): ?>
                                <div class="news-item d-flex align-items-center">
                                    <div class="news-item-thumb">
                                        <img src="<?= $news->getPhoto1('89', '90', 'resize', 'transparent', 'center', 'center'); ?>" alt="">
                                    </div>
                                    <div class="news-item-content">
                                        <span><?= Yii::$app->formatter->asDateTime($news->date, 'php:j F, Y'); ?></span>
                                        <a href="#"><?= StringHelper::truncate(strip_tags($news->getText1()), 50, '...'); ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center">
            <p> <?= Yii::t('app', 'Developed by <a href="{url}">PROACTIVE MEDIA</a>', ['url' => "https://proactive.uz"]) ?></p>
        </div>
    </div>
    <div class="footer-shape-1">
        <img src="/images/shape/shape-5.png" alt="">
    </div>
    <div class="footer-shape-2 animated wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="0ms">
        <img src="/images/shape/shape-6.png" alt="">
    </div>
</footer>

<!--====== FOOTER PART ENDS ======-->

<!--====== GO TO TOP PART START ======-->

<div class="go-top-area">
    <div class="go-top-wrap">
        <div class="go-top-btn-wrap">
            <div class="go-top go-top-btn">
                <i class="fa fa-angle-double-up"></i>
                <i class="fa fa-angle-double-up"></i>
            </div>
        </div>
    </div>
</div>

<!--====== GO TO TOP PART ENDS ======-->
