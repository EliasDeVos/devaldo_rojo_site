<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gyms".
 *
 * @property integer $gymId
 * @property string $street
 * @property string $houseNumber
 * @property string $city
 * @property string $postalCode
 * @property string $hasNuts
 * @property string $priceBeer
 * @property string $hasToBePrepared
 */
class Gym extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'gyms';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['gymId'], 'integer'],
			[['street', 'houseNumber', 'city', 'postalCode', 'hasNuts', 'priceBeer', 'hasToBePrepared'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'gymId' => 'Gym ID',
			'street' => 'Street',
			'houseNumber' => 'House Number',
			'city' => 'City',
			'postalCode' => 'Postal Code',
			'hasNuts' => 'Has Nuts',
			'priceBeer' => 'Price Beer',
			'hasToBePrepared' => 'Has To Be Prepared',
		];
	}
}
