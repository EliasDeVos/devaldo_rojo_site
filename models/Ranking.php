<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rankings".
 *
 * @property integer $rankingId
 * @property integer $teamId
 * @property string $gamesWon
 * @property string $gamesLost
 * @property string $gamesDraw
 * @property string $goalsAgainst
 * @property string $goalsMade
 * @property integer $seasonId
 */
class Ranking extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'rankings';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['teamId', 'seasonId'], 'integer'],
			[['gamesWon', 'gamesLost', 'gamesDraw', 'goalsAgainst', 'goalsMade'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'rankingId' => 'Ranking ID',
			'teamId' => 'Team ID',
			'gamesWon' => 'Games Won',
			'gamesLost' => 'Games Lost',
			'gamesDraw' => 'Games Draw',
			'goalsAgainst' => 'Goals Against',
			'goalsMade' => 'Goals Made',
			'seasonId' => 'Season ID',
		];
	}

	/**
	 * @relations
	 */

	public function getSeason()
	{
		return $this->hasOne(Season::className(), ['seasonId' => 'seasonId']);
	}

	public function getTeam()
	{
		return $this->hasOne(Team::className(), ['teamId' => 'teamId']);
	}

	public function calculatePoints()
	{
		$iPoints = 0;
		$iPoints += $this->gamesWon*3;
		$iPoints += $this->gamesDraw;

		return $iPoints;
	}
    public function calculateMatchPlayed()
    {
        $iMatchPlayed = 0;
        $iMatchPlayed += $this->gamesWon;
        $iMatchPlayed += $this->gamesDraw;
        $iMatchPlayed += $this->gamesLost;

        return $iMatchPlayed;
    }

}
