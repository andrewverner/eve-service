<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scope".
 *
 * @property integer $id
 * @property string $scope
 * @property string $description
 * @property integer $active
 * @property integer $group_id
 */
class Scope extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scope';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['scope'], 'required'],
            [['group_id'], 'integer'],
            [['scope', 'description'], 'string', 'max' => 255],
            [['active'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scope' => 'Scope',
            'description' => 'Description',
            'active' => 'Active',
            'group_id' => 'Group ID',
        ];
    }
}
