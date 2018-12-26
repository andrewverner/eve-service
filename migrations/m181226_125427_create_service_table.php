<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m181226_125427_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service', [
            'id' => $this->primaryKey(),
            'code' => $this->string(255)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
        ], 'charset=utf8');

        $this->dropColumn(\app\models\CharacterService::tableName(), 'service_code');
        $this->addColumn(\app\models\CharacterService::tableName(), 'service_id', 'int not null after id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service');
    }
}
