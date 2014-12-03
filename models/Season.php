<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seasons".
 *
 * @property integer $seasonId
 * @property string $year
 */
class Season extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'seasons';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['seasonId'], 'integer'],
			[['year'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'seasonId' => 'Season ID',
			'year' => 'Year',
		];
	}
}
