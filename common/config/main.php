<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'urlManagerFrontend' => [
            'baseUrl' => 'http://' . (YII_ENV_PROD ? '' : ''),
            'class' => 'yii\web\UrlManager',
            'enableStrictParsing' => false,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => array_merge(require(dirname(dirname(__DIR__)).'/frontend/config/url_rules.php')
            ),
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
