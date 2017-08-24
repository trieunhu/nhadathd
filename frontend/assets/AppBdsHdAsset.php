<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppBdsHdAsset extends AssetBundle {

    public $sourcePath = '@webroot/themes/bdshd/';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/style.css',
        'css/rd-navbar.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.easing.1.3.js',
        'js/rd-navbar.js',
        'js/function.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
