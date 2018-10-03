<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "hash".
 *
 * @property int $id
 * @property int $type
 * @property int $user_id
 * @property string $value
 * @property int $is_used
 * @property string $created
 * @property string $expired
 */
class Hash extends \yii\db\ActiveRecord
{
    const TYPE_ACTIVATE_ACCOUNT = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'is_used'], 'integer'],
            [['value'], 'required'],
            [['created', 'expired'], 'safe'],
            [['value'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'user_id' => 'User ID',
            'value' => 'Value',
            'is_used' => 'Is Used',
            'created' => 'Created',
            'expired' => 'Expired',
        ];
    }

    /**
     * Creates a hash code
     * @param int $userId
     * @param int $type
     * @return Hash
     */
    public static function create($userId = null, $type = self::TYPE_ACTIVATE_ACCOUNT)
    {
        $model = new self();
        $model->type = $type;
        $model->user_id = $userId;
        $model->value = md5(uniqid() . time());
        $model->expired = new Expression('NOW() + INTERVAL 1 DAY');
        $model->save();

        return $model;
    }
}
