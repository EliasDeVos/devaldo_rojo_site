<?php
namespace app\assets;


use yii\web\AssetBundle;

class PlayerAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/players.css',
    ];
    public $js = [
        'scripts/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 