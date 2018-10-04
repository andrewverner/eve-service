<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scope_group`.
 */
class m181004_111833_create_scope_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('scope_group', [
            'id' => $this->primaryKey(),
            'title' => $this->string(45)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scope_group');
    }
}
