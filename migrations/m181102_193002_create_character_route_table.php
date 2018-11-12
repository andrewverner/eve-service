<?php

use yii\db\Migration;

/**
 * Handles the creation of table `character_route`.
 */
class m181102_193002_create_character_route_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('character_route', [
            'id' => $this->primaryKey(),
            'character_id' => $this->integer()->notNull(),
            'route' => $this->text(),
            'name' => $this->string(255),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('character_route');
    }
}
