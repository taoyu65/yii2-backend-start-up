<?php
namespace common\assets;

use yii\web\AssetBundle;
use yii\web\View;

class VueAsset extends AssetBundle
{
    public $baseUrl = '//cdn.jsdelivr.net/npm/vue@2.5.17/dist/';

    public $js = [
        'vue.min.js',
        //'vue.js'
    ];

    public $jsOptions = [
        'position' => View::POS_BEGIN,
    ];
}