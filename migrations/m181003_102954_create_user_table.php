<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m181003_102954_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(45)->notNull(),
            'password' => $this->string(64)->notNull(),
            'email' => $this->string(64)->notNull(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
        ], 'charset=utf8');

        $this->addColumn('token', 'user_id', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
