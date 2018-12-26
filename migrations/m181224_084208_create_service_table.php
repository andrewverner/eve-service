<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m181224_084208_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'service_code' => $this->string('45')->notNull(),
            'character_id' => $this->integer()->notNull(),
            'settings' => $this->string(2048),
            'expired' => $this->dateTime(),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service');
    }
}
