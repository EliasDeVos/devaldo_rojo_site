<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 5/11/2014
 * Time: 16:39
 */

namespace app\controllers;


use app\models\Player;
use app\models\Team;
use yii\web\Controller;

class StatisticsController extends Controller {

	public function actionIndex()
	{
		$oTeam = Team::findOne(['name' => 'Devaldo rojo']);
		$aUitslagen = $oTeam->uitslagen();
		$aGoals = $oTeam->getGoals();
		$aAanwezigheden = $oTeam->getAanwezigheden();
		$sGoals = '';
		$sAanwezigheden = '';
//		var_dump($aGoals);
//		var_dump($aGoals);
		foreach ($aGoals as $oGoal)
		{
//			var_dump($oGoal);
			$sGoals .= $oGoal . ',';
//			var_dump($sGoals);
		}
		substr($sGoals, 0, -1);
		foreach ($aAanwezigheden as $oAanwezigheden)
		{
			$sAanwezigheden .= $oAanwezigheden . ',';
		}
		substr($sAanwezigheden, 0, -1);
		return $this->render('index', ['aUitslagen' => $aUitslagen, 'sGoals' => $sGoals, 'sAanwezigheden' => $sAanwezigheden]);
	}
} 