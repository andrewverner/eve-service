<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.10.18
 * Time: 14:20
 */

namespace app\models;

use yii\base\Model;

class RegForm extends Model
{
    public $username;
    public $password1;
    public $password2;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password1', 'password2', 'email'], 'required'],
            [['username', 'password1', 'password2', 'email'], 'filter', 'filter' => 'trim'],
            [['password1', 'password2'], 'string', 'min' => 6, 'max' => 18],
            [['password2'], 'compare', 'compareAttribute' => 'password1'],
            [['username'], 'string', 'min' => 6, 'max' => 45],
            [['email'], 'email'],
            [['username'], 'checkUnique'],
        ];
    }

    public function attributeLabels()
    {
        /*return [
            'username' => \Yii::t('user', 'Username'),
            'password1' => \Yii::t('user', 'Password'),
            'password2' => \Yii::t('user', 'Password confirmation'),
            'email' => \Yii::t('user', 'Email'),
        ];*/
        return [
            'username' => 'Username',
            'password1' => 'Password',
            'password2' => 'Password confirmation',
            'email' => 'Email',
        ];
    }
    public function checkUnique($attribute)
    {
        if (User::findOne([$attribute => $this->{$attribute}, 'active' => 1])) {
            $message = "{$attribute} already taken";
            $this->addError($attribute, \Yii::t('user', $message, [$attribute => $this->attributeLabels()[$attribute]]));
        }
    }
}
