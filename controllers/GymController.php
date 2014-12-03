<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 3/11/2014
 * Time: 14:45
 */

namespace app\controllers;


use app\models\Gym;
use app\models\Player;
use Yii;
use yii\web\Controller;

class GymController extends Controller
{

	public function actionIndex()
	{
		$aGyms = Gym::find()->all();
		return $this->render('index', ['aGyms' => $aGyms]);
	}

	public function actionNavigate($iGymId)
	{
		$oPlayer = Player::findOne(['playerId' => Yii::$app->user->id]);
		$sDeparture = $oPlayer->street . ' ' . $oPlayer->houseNumber . ' ' . $oPlayer->postalCode . ' ' . $oPlayer->city;
		$oGym = Gym::findOne(['gymId' => $iGymId]);
		$sDestination = $oGym->street . ' ' . $oGym->houseNumber . ' ' . $oGym->postalCode . ' ' . $oGym->city;

		return $this->renderAjax('_googleMaps', ['sDeparture' => $sDeparture, 'sDestination' => $sDestination]);
	}
} 