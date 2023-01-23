<?php

namespace backend\assets;

use yii\web\AssetBundle;

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
        'js/fontawesome-free-6.2.1-web/js/solid.js',
        'js/fontawesome-free-6.2.1-web/js/regular.js',
        'js/fontawesome-free-6.2.1-web/js/fontawesome.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
