<?php
namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class JQueryAsset extends AssetBundle
{
    public $baseUrl = '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/';

    public $js = [
        'jquery.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}