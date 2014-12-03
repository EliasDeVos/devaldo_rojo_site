<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 27/11/2014
 * Time: 17:23
 */

namespace app\models\forms;


use app\models\Goal;
use yii\base\Model;

class GoalForm extends Model{

	public $playerId;

	public function rules()
	{
		return [
			[['playerId'], 'safe']
		];
	}

	public function addGoal($iMatchId)
	{
		$oGoal = new Goal();
		$oGoal->playerId = $this->playerId;
		$oGoal->matchId = $iMatchId;
		if ($oGoal->save())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
} 