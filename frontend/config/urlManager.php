<?php

use codemix\localeurls\UrlManager;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'class' => UrlManager::class,
    'hostInfo' => $params['siteUrl'],
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => false,
    'languages' => ['ru', 'uz', 'en'],
    'enableLanguageDetection' => false,
    'enableDefaultLanguageUrlCode' => true,
    'ignoreLanguageUrlPatterns' => [
        // route pattern => url pattern
    ],
    'rules' => [
        '' => 'site/index',
    ],
];
