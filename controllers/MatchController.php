<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 4/11/2014
 * Time: 17:45
 */

namespace app\controllers;


use app\models\forms\GoalForm;
use app\models\forms\LoginForm;
use app\models\forms\MatchForm;
use app\models\Match;
use app\models\Player;
use app\models\Team;
use Yii;
use yii\web\Controller;

class MatchController extends Controller
{

	public function actionIndex()
	{
		$oTeam = Team::findOne(['name' => 'Devaldo rojo']);
		$aOMatches = Match::find([])->all(); //matchen van de ingelogde speler ophalen niet alle matchen
		$aMatches = array();
		foreach ($aOMatches as $oMatch) {
			$aMatches[$oMatch->matchId] = $oMatch->attributes;
			$aMatches[$oMatch->matchId]['resultaat'] = $oMatch->resultaatPloeg($oTeam->teamId);
		}
		return $this->render('index', ['aMatches' => $aMatches, 'sTeamFromUser' => $oTeam->name]);
	}

	public function actionEditMatch()
	{
		$aGoals = array();
		$oMatchModel = new MatchForm();
		$iMatchId = Yii::$app->request->getQueryParam('matchId');
		if (isset($iMatchId))
		{
			$oMatch = Match::findOne(['matchId' => $iMatchId]);
			$aFormData['MatchForm'] = $oMatch->attributes;
			$oMatchModel->load($aFormData);
			foreach ($oMatch->goals as $oGoal)
			{
				$oGoalForm = new GoalForm();
				$oGoalForm->playerId = $oGoal->playerId;
				$aGoals[] = $oGoalForm;
			}
		}
		return $this->render('editMatch', ['oMatchModel' => $oMatchModel, 'aGoals' => $aGoals]);
	}

	public function actionSaveMatch()
	{
		$oMatchModel = new MatchForm();
		if ($oMatchModel->load(Yii::$app->request->post()) && $oMatchModel->validate())
		{
			if (!$oMatchModel->saveMatch())
			{
				return $this->render('error', ['sMessage' => $oMatchModel->errors]);
			}
		}
		$oGoalModel = new GoalForm();
		$aGoalForms = Yii::$app->request->post('GoalForm');
		if (isset($aGoalForms))
		{
			foreach ($aGoalForms as $oGoalForm)
			{
				$oGoalModel->playerId = $oGoalForm['playerId'];
				if (!$oGoalModel->validate())
				{
					return $this->render('error', ['sMessage' => $oGoalModel->errors]);
				}
				$oGoalModel->addGoal($oMatchModel->matchId);
			}
		}
		return $this->redirect(Yii::$app->urlManager->createUrl('match/index'));
	}
} 