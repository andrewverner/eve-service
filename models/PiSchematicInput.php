<?php

namespace app\models;

use app\components\esi\EVE;
use Yii;

/**
 * This is the model class for table "pi_schematic_input".
 *
 * @property int $id
 * @property int $output_type_id
 * @property int $input_type_id
 * @property int $quantity
 */
class PiSchematicInput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pi_schematic_input';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['output_type_id', 'input_type_id', 'quantity'], 'required'],
            [['output_type_id', 'input_type_id', 'quantity'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'output_type_id' => Yii::t('app', 'Output Type ID'),
            'input_type_id' => Yii::t('app', 'Input Type ID'),
            'quantity' => Yii::t('app', 'Quantity'),
        ];
    }

    /**
     * @return \app\components\esi\universe\Type
     */
    public function outputType()
    {
        return EVE::universe()->type($this->output_type_id);
    }

    /**
     * @return \app\components\esi\universe\Type
     */
    public function inputType()
    {
        return EVE::universe()->type($this->input_type_id);
    }
}
