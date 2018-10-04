<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $active
 * @property string $created
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            [['active'], 'integer'],
            [['created'], 'safe'],
            [['username'], 'string', 'max' => 45],
            [['password', 'email'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'active' => 'Active',
            'created' => 'Created',
        ];
    }

    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['id' => 'user_id']);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }

    public static function findByUsername($username)
    {
        return self::findOne([
            'username' => $username,
            'active' => 1,
        ]);
    }

    public function validatePassword($password)
    {
        return md5($password) == $this->password;
    }

    public function test()
    {
        return 'ttt';
    }
}
