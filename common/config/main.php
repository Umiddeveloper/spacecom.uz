<?php

use afzalroq\cms\Module;
use yii\caching\FileCache;
use himiklab\yii2\recaptcha\ReCaptchaConfig;
use yii\i18n\PhpMessageSource;

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@url' => $params['siteUrl'],
        '@storageRoot' => $params['storageRoot'],
        '@storageHostInfo' => $params['storageHostInfo'],
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'timezone' => 'Asia/Tashkent',
    'components' => [
        'cache' => [
            'class' => FileCache::class,
            'cachePath' => Yii::getAlias('@frontend') . '/runtime/cache'
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
//        'bundles' => [
//            JqueryAsset::class => [
//                'jsOptions' => ['position' => View::POS_HEAD]
//            ]
//        ],
            'appendTimestamp' => true,
        ],

        'reCaptcha' => YII_ENV_PROD ? [
            'class' => ReCaptchaConfig::class,
            'siteKeyV2' => '6LfF1wocAAAAAG3AIN2SwB37aAHefsrcoga6sbRL',
            'secretV2' => '6LfF1wocAAAAAG3EBs6jNlkGOCe8Fm53gyztLLXL',
//            'siteKeyV3' => '',
//            'secretV3' => '',
        ] : [
            'class' => ReCaptchaConfig::class,
            'siteKeyV2' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
            'secretV2' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'cms' => [ // don`t change module key
            'class' => Module::class,
            'path' => $params['storageRoot'], // dirname(__DIR__, 2) . '/storage'
            'host' => $params['storageHostInfo'], // 'https://site.example'
            'fallback' => $params['storageRoot'] . '/fallback.png',
            'languages' => [
                'en' => [
                    'id' => 2,
                    'name' => 'English',
                ],
                'ru' => [
                    'id' => 0,
                    'name' => 'Русский',
                ],
                'uz' => [
                    'id' => 1,
                    'name' => 'O\'zbek tili',
                ],
            ],
            'menuActions' => [ // for add to menu controller actions
                '' => 'Home',
                'site/contacts' => 'Contacts',
            ]
        ],
    ],
];
