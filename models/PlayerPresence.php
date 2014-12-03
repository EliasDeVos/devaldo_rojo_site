<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "playerpresence".
 *
 * @property integer $matchId
 * @property integer $playerId
 */
class PlayerPresence extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'playerpresence';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['matchId', 'playerId'], 'required'],
			[['matchId', 'playerId'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'matchId' => 'Match ID',
			'playerId' => 'Player ID',
		];
	}
}
