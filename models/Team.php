<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teams".
 *
 * @property integer $teamId
 * @property string $name
 * @property string $color
 * @property string $homeGym
 * @property string $gsmNumber
 * @property integer $seasonId
 */
class Team extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'teams';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['teamId', 'seasonId'], 'integer'],
			[['name', 'color', 'homeGym', 'gsmNumber'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'teamId' => 'Team ID',
			'name' => 'Name',
			'color' => 'Color',
			'homeGym' => 'Home Gym',
			'gsmNumber' => 'Gsm Number',
			'seasonId' => 'Season ID',
		];
	}

	/**
	 * @relations
	 */
	public function getPlayers()
	{
		return $this->hasMany(Player::className(), ['teamId' => 'teamId']);
	}

	public function getHomeGames()
	{
		return $this->hasMany(Match::className(), ['homeTeamId' => 'teamId']);
	}

	public function getAwayGames()
	{
		return $this->hasMany(Match::className(), ['awayTeamId' => 'teamId']);
	}


	public function uitslagen()
	{
		$oRanking = Ranking::findOne(['teamId' => $this->teamId]);
		$aUitslagen['gewonnen'] = $oRanking->gamesWon;
		$aUitslagen['verloren'] = $oRanking->gamesLost;
		$aUitslagen['gelijk'] = $oRanking->gamesDraw;

		return $aUitslagen;
	}

	public function getGoals()
	{
		$aHomeGames = $this->homeGames;
		$aAwayGames = $this->awayGames;
		$aGoals = array();
		foreach($aHomeGames as $oHomeGame)
		{
			$aGoals[$oHomeGame->matchTime] = $oHomeGame->goals == null ? 0 : count($oHomeGame->goals);
		}
		foreach($aAwayGames as $oAwayGame)
		{
			$aGoals[$oAwayGame->matchTime] = $oAwayGame->goals == null ? 0 : count($oAwayGame->goals);
		}
		krsort($aGoals);
		return $aGoals;
	}

	public function getAanwezigheden()
	{
		$aHomeGames = $this->homeGames;
		$aAwayGames = $this->awayGames;
		$aAanwezigheden = array();
		foreach($aHomeGames as $oHomeGame)
		{
			$aAanwezigheden[$oHomeGame->matchTime] = $oHomeGame->playerPresence == null ? 0 : count($oHomeGame->playerPresence);
		}
		foreach($aAwayGames as $oAwayGame)
		{
			$aAanwezigheden[$oAwayGame->matchTime] = $oAwayGame->playerPresence == null ? 0 : count($oAwayGame->playerPresence);
		}
		krsort($aAanwezigheden);
		return $aAanwezigheden;
	}
}
