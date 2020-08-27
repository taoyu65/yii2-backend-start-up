<?php
namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class FontAwesomeAsset extends AssetBundle
{
//    public $baseUrl = '//use.fontawesome.com/releases/v5.0.6/css/';
    public  $basePath = '//kit.fontawesome.com/';
//    public $css = [
////        'all.css',
//    ];

    public $js = [
        [
            '82616e3b5c.js',
            'data' => [
                'crossorigin' => 'anonymous',
            ],
        ],

    ];

//    public $cssOptions = [
//        'position' => View::POS_HEAD,
//    ];
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
}