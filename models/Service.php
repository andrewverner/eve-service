<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $code
 * @property string $title
 * @property string $description
 * @property integer $cost
 */
class Service extends \yii\db\ActiveRecord
{
    const SKILL_QUEUE_NOTIFICATOR = 'skill-queue-notificator';

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
            [['code', 'title'], 'required'],
            [['description'], 'string'],
            [['code', 'title'], 'string', 'max' => 255],
            [['cost'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'title' => 'Title',
            'description' => 'Description',
            'cost' => 'Cost',
        ];
    }
}
