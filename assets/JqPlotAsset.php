<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JqPlotAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/jquery.jqplot.css',
		'css/tabs.css'
	];
	public $js = [
		'scripts/main.js',
		'scripts/jquery.jqplot.js',
		'scripts/excanvas.js',
		'scripts/jqplot/plugins/jqplot.barRenderer.min.js',
		'scripts/jqplot/plugins/jqplot.categoryAxisRenderer.min.js',
		'scripts/jqplot/plugins/jqplot.cursor.min.js',
		'scripts/jqplot/plugins/jqplot.ohlcRenderer.min.js',
		'scripts/jqplot/plugins/jqplot.pointLabels.min.js',
		'scripts/jqplot/plugins/jqplot.pieRenderer.min.js',
		'scripts/jqplot/plugins/jqplot.donutRenderer.min.js',
        'scripts/jqplot/plugins/jqplot.dateAxisRenderer.min.js',
        'scripts/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js',
        'scripts/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js',
        'scripts/tabs.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}