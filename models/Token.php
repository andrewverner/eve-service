<?php

namespace app\models;

use Yii;

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
 */
class Token extends \yii\db\ActiveRecord
{
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
            [['expires_on', 'created', 'updated'], 'safe'],
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

    public function getCharacter()
    {
        return EVEAPI::api()->character($this->character_id, $this->access_token);
    }

    public function getScopes()
    {
        return unserialize($this->scopes);
    }

    public function can(string $scope)
    {
        return in_array($scope, $this->getScopes());
    }

    public function check()
    {
        if (new \DateTime($this->expires_on) >= new \DateTime()) {
            $api = EVEAPI::api();
            $token = $api->sso()->refreshToken($this->refresh_token);
            if ($token) {
                $this->access_token = $token->accessToken;
                $this->save();
            }
        }
    }
}
