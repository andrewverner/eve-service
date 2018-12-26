<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hash`.
 */
class m181003_163750_create_hash_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('hash', [
            'id' => $this->primaryKey(),
            'type' => $this->integer(2)->notNull()->defaultValue(1),
            'user_id' => $this->integer(),
            'value' => $this->string(32)->notNull(),
            'is_used' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'expired' => $this->dateTime()
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('hash');
    }
}
