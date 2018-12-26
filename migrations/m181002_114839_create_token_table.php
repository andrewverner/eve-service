<?php

use yii\db\Migration;

/**
 * Handles the creation of table `token`.
 */
class m181002_114839_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('token', [
            'id' => $this->primaryKey(),
            'character_id' => $this->integer()->notNull(),
            'character_name' => $this->string()->notNull(),
            'expires_on' => $this->dateTime()->notNull(),
            'token_type' => $this->string(),
            'character_owner_hash' => $this->string(),
            'intellectual_property' => $this->string(),
            'scopes' => $this->text()->notNull(),
            'created' => $this->dateTime()->notNull(),
            'updated' => $this->dateTime()
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('token');
    }
}
