<?php
namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class FontAwesomeAsset extends AssetBundle
{
    public $baseUrl = '//use.fontawesome.com/releases/v5.0.6/css/';

    public $css = [
        'all.css',
    ];

    public $cssOptions = [
        'position' => View::POS_HEAD,
    ];
}