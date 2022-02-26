<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/avatar2.jpeg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [

                    YII_ENV === 'dev' ? ['label' => 'CMS', 'icon' => 'th-list', 'url' => ['/cms/home']] : [],
                    ['label' => 'Management', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Menu',
                        'icon' => 'bars',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('admin'),
                        'items' => [
                            ['label' => 'Main menu', 'icon' => 'th-list', 'url' => ['/cms/menu/index?slug=main']],
                            ['label' => 'Footer menu', 'icon' => 'th-list', 'url' => ['/cms/menu/index?slug=footer-main']],
                            ['label' => '3 cards', 'icon' => 'th-large', 'url' => ['/cms/unit-categories/unit?slug=main-page-three-units']],
                            ['label' => 'A card about the site', 'icon' => 'th-large', 'url' => ['/cms/unit-categories/unit?slug=main-page-about-card']],
                            ['label' => 'Video card', 'icon' => 'th-large', 'url' => ['/cms/unit-categories/unit?slug=main-page-video']],
                        ]
                    ],
                    [
                            'label' => 'Categories',
                            'visible' => Yii::$app->user->can('admin'),
                            'icon' => 'tags',
                            'url' => ['/cms/options/index?slug=category']
                    ],
                    [
                            'label' => 'Tags',
                            'visible' => Yii::$app->user->can('admin'),
                            'icon' => 'link',
                            'url' => ['/cms/options/index?slug=tags']
                    ],

                    ['label' => 'Pages', 'icon' => 'list-alt', 'url' => ['/cms/items/index?slug=pages']],
                    ['label' => 'News', 'icon' => 'list-alt', 'url' => ['/cms/items/index?slug=news']],
                    ['label' => 'Slider', 'icon' => 'list-alt', 'url' => ['/cms/items/index?slug=slider']],
                    ['label' => 'Partners', 'icon' => 'user', 'url' => ['/cms/items/index?slug=partners']],
                    ['label' => 'Study materials', 'icon' => 'font', 'url' => ['/cms/items/index?slug=teaching-materials']],
                    ['label' => 'Presentations', 'icon' => 'font', 'url' => ['/cms/items/index?slug=presentations']],
                    ['label' => 'Certificates', 'icon' => 'font', 'url' => ['/cms/items/index?slug=sertificates']],
                    ['label' => 'Meetings', 'icon' => 'font', 'url' => ['/cms/items/index?slug=meetings']],
                    ['label' => 'Media / Video', 'icon' => 'youtube-play', 'url' => ['/cms/items/index?slug=media-video']],
                    ['label' => 'Published materials', 'icon' => 'font', 'url' => ['/cms/items/index?slug=published-meterials']],
                    ['label' => 'Educational', 'icon' => 'font', 'url' => ['/cms/items/index?slug=educational']],
                    ['label' => 'Promotions', 'icon' => 'font', 'url' => ['/cms/items/index?slug=promotions']],
                    ['label' => 'Files', 'icon' => 'file', 'url' => ['/cms/file']],
                    ['label' => 'Photo gallery', 'icon' => 'image', 'url' => ['/cms/items/index?slug=photo-gallery']],
                    ['label' => 'Social networks', 'icon' => 'link', 'url' => ['/cms/unit-categories/unit?slug=socialnetwork']],
                    ['label' => 'Main Page Banner', 'icon' => 'image', 'url' => ['/cms/items/index?slug=main-page-banner']],
                    ['label' => Yii::t('app','Faqs'), 'icon' => '', 'url' => ['/faq/index']],
                    [
                        'label' => Yii::t('app','Notifications'), 'icon' => '', 'url' =>
                        [
                            Yii::$app->user->can('admin') ? '/notifications/index' : '/notification-items/index'
                        ]
                    ],
                    ['label' => Yii::t('app','User'), 'icon' => 'address-book', 'url' => ['/user/index']],
                ],
            ]
        ) ?>
    </section>
</aside>
