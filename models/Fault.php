<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faults".
 *
 * @property integer $matchId
 * @property integer $playerId
 * @property string $type
 * @property string $quarter
 */
class Fault extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'faults';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['matchId', 'playerId'], 'required'],
			[['matchId', 'playerId'], 'integer'],
			[['type', 'quarter'], 'string', 'max' => 45]
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
			'type' => 'Type',
			'quarter' => 'Quarter',
		];
	}
}
