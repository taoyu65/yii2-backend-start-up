<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'urlManager' => [
            'baseUrl' => YII_ENV_PROD ? 'https://loveswapsy.com' : 'http://localhost:5556',
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
        'authManager' => [
            'class' => '\backend\components\rbac\DbManager',
        ],
    ],
];
