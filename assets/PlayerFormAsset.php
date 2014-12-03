<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 24/11/2014
 * Time: 19:10
 */

namespace app\assets;


use yii\web\AssetBundle;

class PlayerFormAsset extends AssetBundle {

	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/site.css',
		'css/playerFormCss.css'
	];
	public $js = [
		'scripts/main.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
} 