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
            [['character_id', 'character_name', 'expires_on', 'scopes', 'created'], 'required'],
            [['character_id'], 'integer'],
            [['expires_on', 'created', 'updated'], 'safe'],
            [['scopes'], 'string'],
            [['character_name', 'token_type', 'character_owner_hash', 'intellectual_property'], 'string', 'max' => 255],
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
        ];
    }
}
