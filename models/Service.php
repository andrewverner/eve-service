<?php

namespace app\models;

use app\models\services\ServiceFactory;
use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $service_code
 * @property integer $character_id
 * @property string $settings
 * @property string $expired
 */
class Service extends \yii\db\ActiveRecord
{
    const SERVICE_SKILL_QUEUE_NOTIFIER = 'skill-queue-notifier';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_code', 'character_id'], 'required'],
            [['character_id'], 'integer'],
            [['expired'], 'safe'],
            [['service_code'], 'string', 'max' => 45],
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
            'service_code' => 'Service Code',
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
}
