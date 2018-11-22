<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pi_commodity`.
 */
class m181122_142554_create_pi_commodity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_commodity', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'name' => $this->string(45)->notNull(),
            'level' => $this->integer(1)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_commodity');
    }
}
