<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plug/zui/css/zui.min.css',
        'css/base.css?v=1',
        'css/common.css?v=1',
        'css/index.css',
    ];
    public $js = [
        'js/jquery.lazyload.min.js?v=2016.12.6',
        'js/common.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];

    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile.'?v=2017.9.1', [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile.'?v=2017.9.1', [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }
}
