<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 5/11/2014
 * Time: 10:53
 */

namespace app\models\forms;


use app\models\Match;
use yii\base\Model;

class MatchForm extends Model{

	public $matchId;
	public $awayTeamId;
	public $homeTeamId;
	public $homeTeamGoals;
	public $awayTeamGoals;
	public $gymId;
	public $seasonId;
	public $matchTime;

	public function rules()
	{
		return [
			[['awayTeamId', 'homeTeamId', 'homeTeamGoals', 'awayTeamGoals', 'gymId', 'seasonId'], 'required'],
			[['matchId', 'matchTime'], 'safe'],
			[['awayTeamId', 'homeTeamId', 'homeTeamGoals', 'awayTeamGoals', 'gymId', 'seasonId'], 'integer'],
			[['awayTeamId', 'homeTeamId'], 'differentTeams'],
		];
	}

	public function differentTeams($attribute)
	{
		if ($this->awayTeamId == $this->homeTeamId) {
			$this->addError($attribute, 'Team kan niet tegen zichzelf spelen');
		}
	}

	public function saveMatch()
	{
		$oMatch = Match::findOne(['matchId' => $this->matchId]);
		if (!isset($oMatch))
		{
			$oMatch = new Match();
		}
		$oMatch->attributes = $this->attributes;
		if ($oMatch->save())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
} 