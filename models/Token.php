<?php

namespace app\models;

use app\components\esi\components\Request;
use app\components\esi\EVE;
use yii\db\Expression;

/**
 * This is the model class for table "token".
 *
 * @property int $id
 * @property int $character_id
 * @property string $character_name
 * @property string $expires_on
 * @property string $token_type
 * @property string $character_owner_hash
 * @property string $intellectual_property
 * @property string $scopes
 * @property string $created
 * @property string $updated
 * @property int $user_id
 * @property string $refresh_token
 * @property string $access_token
 *
 * @property CharacterService[]|null $services
 */
class Token extends \yii\db\ActiveRecord
{
    private $character;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['character_id', 'character_name', 'expires_on', 'scopes', 'created', 'user_id', 'refresh_token', 'access_token'], 'required'],
            [['character_id', 'user_id'], 'integer'],
            [['expires_on', 'created', 'updated', 'scopes'], 'safe'],
            [['scopes'], 'string'],
            [['character_name', 'token_type', 'character_owner_hash', 'intellectual_property', 'access_token'], 'string', 'max' => 255],
            [['refresh_token'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'character_id' => 'Character ID',
            'character_name' => 'Character Name',
            'expires_on' => 'Expires On',
            'token_type' => 'Token Type',
            'character_owner_hash' => 'Character Owner Hash',
            'intellectual_property' => 'Intellectual Property',
            'scopes' => 'Scopes',
            'created' => 'Created',
            'updated' => 'Updated',
            'user_id' => 'User ID',
            'refresh_token' => 'Refresh Token',
        ];
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return unserialize($this->scopes);
    }

    /**
     * @param string $scope
     * @return bool
     */
    public function can(string $scope)
    {
        return in_array($scope, $this->getScopes());
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return new \DateTime($this->expires_on) <= (new \DateTime())->modify('-15 sec');
    }

    /**
     * @return bool
     */
    public function refresh()
    {
        $sso = EVE::sso();
        $token = $sso->refreshToken($this->refresh_token);
        if (!$token) {
            return false;
        }

        $verify = $sso->verify($token->accessToken);
        if (!$verify) {
            return false;
        }

        $this->access_token = $token->accessToken;
        $this->refresh_token = $token->refreshToken;
        $this->expires_on = $verify->expiresOn->format('Y-m-d H:i:s');
        $this->scopes = serialize($verify->scopes);
        $this->save();

        return true;
    }

    public function beforeSave($insert)
    {
        $this->updated = new Expression('NOW()');

        return parent::beforeSave($insert);
    }

    /**
     * @param $scope
     * @return bool
     */
    public function hasAccess($scope)
    {
        return in_array($scope, $this->getScopes());
    }

    /**
     * @return \app\components\esi\character\Character
     * @throws \yii\web\NotFoundHttpException
     */
    public function character()
    {
        if (!$this->character) {
            $this->character = EVE::character($this->character_id, $this);
        }

        return $this->character;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(CharacterService::className(), ['character_id' => 'character_id']);
    }

    /**
     * @return Token
     */
    public static function getSystemToken()
    {
        return self::find()->where(['system' => 1])->one();
    }
}
