<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cashregisters".
 *
 * @property integer $cashRegisterId
 * @property string $name
 * @property integer $balance
 * @property string $accountNumber
 */
class CashRegister extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'cashregisters';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['cashRegisterId', 'balance'], 'integer'],
			[['name', 'accountNumber'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'cashRegisterId' => 'Cash Register ID',
			'name' => 'Name',
			'balance' => 'Balance',
			'accountNumber' => 'Account Number',
		];
	}

	/**
	 * @relations
	 */
	public function getFines()
	{
		return $this->hasMany(Fine::className(), ['cashRegisterId' => 'cashRegisterId']);
	}

	public function getInvoices()
	{
		return $this->hasMany(Invoice::className(), ['cashRegisterId' => 'cashRegisterId']);
	}
}
