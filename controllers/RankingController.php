<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 3/11/2014
 * Time: 13:43
 */

namespace app\controllers;


use app\models\forms\RankingForm;
use app\models\Ranking;
use app\models\Team;
use Yii;
use yii\web\Controller;

class RankingController extends Controller
{
	public function actionIndex()
	{
		$aRankings = array();
		foreach(Ranking::find()->all() as $oRanking)
		{
			$aRankingsData = array();
			$aRankingsData['teamName'] = Team::findOne(['teamId' => $oRanking->teamId])->name;
			$aRankingsData['gamesWon'] = $oRanking->gamesWon;
			$aRankingsData['gamesLost'] = $oRanking->gamesLost;
			$aRankingsData['gamesDraw'] = $oRanking->gamesDraw;
			$aRankingsData['goalsMade'] = $oRanking->goalsMade;
			$aRankingsData['goalsAgainst'] = $oRanking->goalsAgainst;
			$aRankingsData['points'] = $oRanking->calculatePoints();
            $aRankingsData['gamesPlayed']=$oRanking->calculateMatchPlayed();
			$aRankings[] = $aRankingsData;
		}
		usort($aRankings, function($aRankingB, $aRankingA)
		{
			if ($aRankingA['gamesWon'] == $aRankingB['gamesWon'])
			{
				if ($aRankingA['gamesDraw'] == $aRankingB['gamesDraw'])
				{
					return 0;
				}
				else return $aRankingA['gamesDraw'] - $aRankingB['gamesDraw'];
			}
			else return $aRankingA['gamesWon'] - $aRankingB['gamesWon'];
		});
		return $this->render('index', ['aRankings' => $aRankings]);
	}

	public function actionEditRanking()
	{
		$aRankings = Ranking::find()->all();
		$oRankingModel = new RankingForm();
		return $this->render('editRanking', ['aRankings' => $aRankings, 'oRankingModel' => $oRankingModel]);

	}

	public function actionSaveRanking()
	{
		$oRankingModel = new RankingForm();
		$aRankingModels = Yii::$app->request->post('Ranking');
		if (isset($aRankingModels))
		{
			foreach ($aRankingModels as $oRankingForm)
			{
				$oRankingModel->attributes = $oRankingForm;
				if (!$oRankingModel->validate())
				{
					return $this->render('error', ['sMessage' => $oRankingModel->errors]);
				}
				$oRankingModel->update();
			}
		}
		return $this->redirect(Yii::$app->urlManager->createUrl('ranking/index'));
	}
} 