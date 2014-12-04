<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 5/11/2014
 * Time: 10:53
 */

namespace app\models\forms;


use app\models\Match;
use app\models\PlayerPresence;
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
    public $present;

	public function rules()
	{
		return [
			[['awayTeamId', 'homeTeamId', 'gymId', 'seasonId'], 'required'],
			[['matchId', 'matchTime','homeTeamGoals', 'awayTeamGoals', 'present'], 'safe'],
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
        PlayerPresence::deleteAll(['matchId' => $oMatch->matchId]);
        foreach ($this->present as $iPlayerId)
        {
            $oPlayerPresence = new PlayerPresence();
            $oPlayerPresence->playerId = $iPlayerId;
            $oPlayerPresence->matchId = $oMatch->matchId;
            $oPlayerPresence->save();
        }
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