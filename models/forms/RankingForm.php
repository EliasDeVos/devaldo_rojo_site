<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 1/12/2014
 * Time: 13:58
 */

namespace app\models\forms;


use app\models\Ranking;
use yii\base\Model;

class RankingForm extends Model{

	public $teamId;
	public $gamesWon;
	public $gamesDraw;
	public $gamesLost;
	public $goalsAgainst;
	public $goalsMade;

	public function rules()
	{
		return [
			[['gamesWon', 'gamesDraw', 'gamesLost', 'goalsAgainst', 'goalsMade', 'teamId'], 'safe'],
			[['gamesWon', 'gamesDraw', 'gamesLost', 'goalsAgainst', 'goalsMade'], 'integer']
		];
	}

	public function update()
	{
		$oRanking = Ranking::findOne(['teamId' => $this->teamId]);
		$oRanking->attributes = $this->attributes;
		if ($oRanking->save())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
} 