<?php
/**
 * Created by PhpStorm.
 * User: Pol
 * Date: 24/11/2014
 * Time: 15:20
 */

namespace app\models\forms;


use app\models\Player;
use yii\base\Model;

class PlayerForm extends Model {

	public $playerId;
	public $firstName;
	public $lastName;
	public $birthdate;
	public $street;
	public $houseNumber;
	public $city;
	public $postalCode;
	public $isInjured;
	public $password;
	public $email;
	public $gsmNumber;

	public function rules()
	{
		return [
			[['firstName', 'lastName', 'street', 'houseNumber', 'city', 'postalCode', 'isInjured', 'password', 'email', 'gsmNumber'], 'required'],
			[['playerId', 'birthdate'], 'safe'],
			[['email'], 'match', 'pattern' => '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^', 'message' => 'Geen geldige email'],
		];
	}

	public function savePlayer()
	{
		$oPlayer = Player::findOne(['playerId' => $this->playerId]);
		$oPlayer->attributes = $this->attributes;
		if ($oPlayer->save())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
} 