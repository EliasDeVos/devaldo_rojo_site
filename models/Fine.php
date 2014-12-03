<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fines".
 *
 * @property integer $matchId
 * @property integer $playerId
 * @property string $type
 * @property string $price
 * @property integer $cashRegisterId
 */
class Fine extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'fines';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['matchId', 'playerId'], 'required'],
			[['matchId', 'playerId', 'cashRegisterId'], 'integer'],
			[['type', 'price'], 'string', 'max' => 45]
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
			'price' => 'Price',
			'cashRegisterId' => 'Cash Register ID',
		];
	}
}
