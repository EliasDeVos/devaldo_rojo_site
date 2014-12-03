<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoices".
 *
 * @property integer $invoiceId
 * @property string $description
 * @property string $price
 * @property integer $cashRegisterId
 */
class Invoice extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'invoices';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['invoiceId', 'cashRegisterId'], 'integer'],
			[['description', 'price'], 'string', 'max' => 45]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'invoiceId' => 'Invoice ID',
			'description' => 'Description',
			'price' => 'Price',
			'cashRegisterId' => 'Cash Register ID',
		];
	}
}
