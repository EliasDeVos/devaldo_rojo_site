<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goals".
 *
 * @property string $playerId
 * @property string $matchId
 * @property string $quarter
 * @property string $type
 */
class Goal extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'goals';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['playerId', 'matchId'], 'required'],
			[['quarter', 'type'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'playerId' => 'Player ID',
			'matchId' => 'Match ID',
			'quarter' => 'Quarter',
			'type' => 'Type',
		];
	}
}
