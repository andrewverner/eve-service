<?php

use yii\db\Migration;
use app\models\Service;

/**
 * Handles adding cost to table `{{%service}}`.
 */
class m190625_085326_add_cost_column_to_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Service::tableName(), 'cost', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Service::tableName(), 'cost');
    }
}
