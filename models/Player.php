<?php

namespace app\models;

use Faker\Provider\DateTime;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "players".
 *
 * @property integer $playerId
 * @property string $firstName
 * @property string $lastName
 * @property string $birthdate
 * @property string $street
 * @property string $houseNumber
 * @property string $city
 * @property string $postalCode
 * @property string $preferredPosition
 * @property string $isInjured
 * @property string $shotPrecission
 * @property string $speed
 * @property string $condition
 * @property string $dribble
 * @property string $power
 * @property resource $picture
 * @property string $password
 * @property string $email
 * @property integer $teamId
 * @property string $isCaptain
 * @property string $gsmNumber
 * @property integer $seasonId
 * @property string $authKey
 */
class Player extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    public function getUsername()
    {
        return $this->firstName;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['playerId', 'teamId', 'seasonId'], 'integer'],
            [['birthdate'], 'safe'],
            [['picture'], 'string'],
            [['firstName', 'lastName', 'street', 'houseNumber', 'city', 'postalCode', 'preferredPosition', 'isInjured', 'shotPrecission', 'speed', 'condition', 'dribble', 'power', 'password', 'email', 'isCaptain', 'gsmNumber'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'playerId' => 'Player ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'birthdate' => 'Birthdate',
            'street' => 'Street',
            'houseNumber' => 'House Number',
            'city' => 'City',
            'postalCode' => 'Postal Code',
            'preferredPosition' => 'Preferred Position',
            'isInjured' => 'Is Injured',
            'shotPrecission' => 'Shot Precission',
            'speed' => 'Speed',
            'condition' => 'Condition',
            'dribble' => 'Dribble',
            'power' => 'Power',
            'picture' => 'Picture',
            'password' => 'Password',
            'email' => 'Email',
            'teamId' => 'Team ID',
            'isCaptain' => 'Is Captain',
            'gsmNumber' => 'Gsm Number',
            'seasonId' => 'Season ID',
        ];
    }

    /**
     * Relations
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['teamId' => 'teamId']);
    }

    public function getMatches()
    {
        return $this->hasMany(Match::className(), ['matchId' => 'matchId'])
            ->viaTable('playerPresence', ['playerId' => 'playerId']);
    }

    public function getFaults()
    {
        return $this->hasMany(Fault::className(), ['playerId' => 'playerId']);
    }

    public function getFines()
    {
        return $this->hasMany(Fine::className(), ['playerId' => 'playerId']);
    }

    public function getAssists()
    {
        return $this->hasMany(Assist::className(), ['playerId' => 'playerId']);
    }

    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['playerId' => 'playerId']);
    }

    public function getSeason()
    {
        return $this->hasOne(Season::className(), ['seasonId' => 'seasonId']);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return Player::findOne(['playerId' => $id]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return Player::findOne(['accessToken' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->playerId;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $authKey == $this->authKey ? TRUE : FALSE;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public static function findByUsername($username)
    {
        return Player::findOne(['firstName' => $username]);
    }

    public function isPresentOnNextMatch()
    {
        $dDateNow = new \DateTime();
        $oTeam = Team::findOne(['name' => 'Devaldo rojo']);
        $aAwayMatches = $oTeam->awayGames;
        $aHomeMatches = $oTeam->homeGames;
        usort(
            $aHomeMatches, function ($oMatchA, $oMatchB) {
                $dMatchA = new \DateTime($oMatchA->matchTime);
                $dMatchB = new \DateTime($oMatchB->matchTime);
                return $dMatchA->diff($dMatchB)->format('%R%a');
            });
        usort(
            $aAwayMatches, function ($oMatchB, $oMatchA) {
                $dMatchA = new \DateTime($oMatchA->matchTime);
                $dMatchB = new \DateTime($oMatchB->matchTime);
                return $dMatchA->diff($dMatchB)->format('%R%a');
            });
        $i = 0;
        do {
            $dMatchDate = new \DateTime($aAwayMatches[$i]->matchTime);
            if ($dDateNow->diff($dMatchDate)->format('%R%a') > 0) {
                $oMatchAway = $aAwayMatches[$i];
            }
            $i++;
        } while ($dDateNow->diff($dMatchDate)->format('%R%a') > 0 && $i < count($aAwayMatches));
        $i = 0;

        do {
            $dMatchDate = new \DateTime($aHomeMatches[$i]->matchTime);
            if ($dDateNow->diff($dMatchDate)->format('%R%a') > 0) {
                $oMatchHome = $aHomeMatches[$i];
            }
            $i++;
        } while ($dDateNow->diff($dMatchDate)->format('%R%a') > 0 && $i < count($aHomeMatches));
        $dAwayMatch = new \DateTime($oMatchAway->matchTime);
        $dHomeMatch = new \DateTime($oMatchHome->matchTime);
        if (($dDateNow->diff($dAwayMatch)->format('%R%a')) < ($dDateNow->diff($dHomeMatch)->format('%R%a'))) {
            $oMatch = $oMatchAway;
        }
        else {
            $oMatch = $oMatchHome;
        }
        if (isset($oMatch)) {
            foreach ($oMatch->playerPresence as $oPlayerPresence) {
                if ($oPlayerPresence->playerId = $this->playerId) {
                    return TRUE;
                }
            }
        }

        return FALSE;
    }
}
