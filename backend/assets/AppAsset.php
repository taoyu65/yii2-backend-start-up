<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'css/backend.css?v=20200707'
    ];

    public $js = [
        ['js/site.js'],
        [
            'https://kit.fontawesome.com/82616e3b5c.js',
            'data' => [
                'crossorigin' => 'anonymous',
            ],
        ]
    ];

    public $jsOptions = ['position' => View::POS_HEAD];

    public $depends = [
        'common\assets\JQueryAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
