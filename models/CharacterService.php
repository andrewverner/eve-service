<?php

namespace app\models;

use app\models\services\ServiceFactory;
use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $service_id
 * @property integer $character_id
 * @property string $settings
 * @property string $expired
 *
 * @property Service $service
 */
class CharacterService extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'character_id'], 'required'],
            [['character_id', 'service_id'], 'integer'],
            [['expired'], 'safe'],
            [['settings'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'character_id' => 'Character ID',
            'settings' => 'Settings',
            'expired' => 'Expired',
        ];
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isExpired()
    {
        if (!$this->expired) {
            return false;
        }

        return new \DateTime($this->expired) <= new \DateTime();
    }

    /**
     * @return services\ServiceSetting
     */
    public function settings()
    {
        return ServiceFactory::initService($this);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
