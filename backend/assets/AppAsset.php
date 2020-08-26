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
    ];

    public $js = [
        'js/site.js',
    ];

    public $jsOptions = ['position' => View::POS_HEAD];

    public $depends = [
        'common\assets\JQueryAsset',
        'yii\bootstrap4\BootstrapAsset',
        'common\assets\FontAwesomeAsset',
    ];
}
