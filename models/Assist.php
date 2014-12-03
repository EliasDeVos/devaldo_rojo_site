<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assists".
 *
 * @property integer $assistMakerId
 * @property integer $goalMakerId
 */
class Assist extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'assists';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['assistMakerId', 'goalMakerId'], 'required'],
			[['assistsId', 'assistMakerId', 'goalMakerId'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'assistsId' => 'Assists ID',
			'assistMakerId' => 'Assist Maker ID',
			'goalMakerId' => 'Goal Maker ID',
		];
	}
}
