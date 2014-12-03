<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 3/11/2014
 * Time: 14:48
 */

namespace app\controllers;


use app\models\forms\PlayerForm;
use app\models\Player;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class PlayerController extends Controller{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['showError'],
				'rules' => [
					[
						'actions' => ['showError'],
						'allow' => true,
						'roles' => ['@', '?'],
					],
				],
			],
		];
	}

	public function actionIndex()
	{
		$aPlayers = Player::findAll(['seasonId' => 1]);
		return $this->render('index', ['aPlayers' => $aPlayers]);
	}

	public function actionEditPlayer()
	{
		$iPlayerId = \Yii::$app->request->getQueryParam('playerId');
		$oPlayer = Player::findOne(['playerId' => $iPlayerId]);
		$oPlayerModel = new PlayerForm();
		$aFormData['PlayerForm'] = $oPlayer->attributes;
		$oPlayerModel->load($aFormData);
		$oPlayerModel->playerId = $iPlayerId;

		return $this->render('editPlayer', ['oPlayerModel' => $oPlayerModel]);
	}

	public function actionSavePlayer()
	{
		$oPlayerModel = new PlayerForm();
		$oPlayerModel->load(Yii::$app->request->post());
		if ($oPlayerModel->validate())
		{
			if (!$oPlayerModel->savePlayer())
			{
				return $this->render('error', ['sMessage' => $oPlayerModel->errors]);
			}
			return $this->redirect(\Yii::$app->urlManager->createUrl("site/index"));
		}
		else
		{
			return $this->render('editPlayer', ['oPlayerModel' => $oPlayerModel]);
		}
	}
} 