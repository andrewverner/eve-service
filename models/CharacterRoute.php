<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "character_route".
 *
 * @property integer $id
 * @property integer $character_id
 * @property string $route
 * @property string $name
 * @property string $created
 * @property string $hash
 * @property integer $share
 */
class CharacterRoute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id'], 'required'],
            [['character_id'], 'integer'],
            [['route'], 'string'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 64],
            [['share'], 'integer', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'character_id' => 'Character ID',
            'route' => 'Route',
            'name' => 'Name',
            'created' => 'Created',
            'hash' => 'Hash',
            'share' => 'Share',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->hash = substr(md5($this->character_id . time() . uniqid() . md5($this->route)) . md5($this->route . time()), 0, 64);
        }
        return parent::beforeSave($insert);
    }

    public function getShareLink()
    {
        return Yii::$app->urlManager->createAbsoluteUrl(['/share/route', 'hash' => $this->hash]);
    }
}
