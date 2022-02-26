<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/bootstrap.min.css',
        '/css/font-awesome.min.css',
        '/css/flaticon.css',
        '/css/odometer.min.css',
        '/css/animate.min.css',
        '/css/nice-select.css',
        '/css/magnific-popup.css',
        '/css/slick.css',
        '/css/default.css',
        '/css/style.css',
        'css/main.css',
        'css/responsive.css',
        'css/infinite-scroll'
    ];
    public $js = [
        '/js/vendor/modernizr-3.6.0.min.js',
//        '/js/vendor/jquery-3.5.0.js',
        '/js/bootstrap.min.js',
        '/js/popper.min.js',
        '/js/ajax-contact.js',
        '/js/slick.min.js',
        '/js/odometer.min.js',
        '/js/jquery.appear.min.js',
        '/js/jquery.nice-select.min.js',
        '/js/wow.js',
        '/js/jquery.magnific-popup.min.js',
        '/js/main.js',
        '/js/search.js'
    ];
    public $depends = [
        YiiAsset::class,
    ];
}
