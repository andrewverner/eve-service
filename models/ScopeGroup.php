<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scope_group".
 *
 * @property integer $id
 * @property string $title
 */
class ScopeGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scope_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return Scope[]|null
     */
    public function getScopes()
    {
        return $this->hasMany(Scope::className(), ['group_id' => 'id'])->all();
    }
}
