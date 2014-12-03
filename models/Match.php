<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matches".
 *
 * @property integer $matchId
 * @property string $matchTime
 * @property integer $gymId
 * @property integer $awayTeamId
 * @property integer $homeTeamId
 * @property integer $homeTeamGoals
 * @property integer $awayTeamGoals
 * @property integer $seasonId
 */
class Match extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'matches';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['matchId', 'gymId', 'awayTeamId', 'homeTeamId', 'homeTeamGoals', 'awayTeamGoals', 'seasonId'], 'integer'],
			[['matchTime'], 'safe']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'matchId' => 'Match ID',
			'matchTime' => 'Match Time',
			'gymId' => 'Gym ID',
			'awayTeamId' => 'Away Team ID',
			'homeTeamId' => 'Home Team ID',
			'homeTeamGoals' => 'Home Team Goals',
			'awayTeamGoals' => 'Away Team Goals',
			'seasonId' => 'Season ID',
		];
	}

	/**
	 * @relatioons
	 */
	public function getGoals()
	{
		return $this->hasMany(Goal::className(), ['matchId' => 'matchId']);
	}

	public function getGym()
	{
		return $this->hasOne(Gym::className(), ['gymId' => 'gymId']);
	}

	public function getAssists()
	{
		return $this->hasMany(Assist::className(), ['matchId' => 'matchId']);
	}

	public function getPlayerPresence()
	{
		return $this->hasMany(PlayerPresence::className(), ['matchId' => 'matchId']);
	}

	public function getFaults()
	{
		return $this->hasMany(Fault::className(), ['matchId' => 'matchId']);
	}

	public function getSeason()
	{
		return $this->hasOne(Season::className(), ['seasonId' => 'seasonId']);
	}

	public function resultaatPloeg($iTeamId)
	{
		$iUitslag = $this->homeTeamGoals - $this->awayTeamGoals;
		if ($iUitslag == 0)
		{
			return 0;
		}
		if ($this->awayTeamId == $iTeamId)
		{
			$iUitslag *= -1;
		}
		return $iUitslag > 0 ? 1 : -1;
	}
}
