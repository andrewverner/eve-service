<?php

use yii\db\Migration;

/**
 * Handles the creation of table `queue`.
 */
class m181225_115416_create_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('queue_tasks', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull(),
            'body' => $this->text(),
            'status' => $this->integer(2)->notNull()->defaultValue(0),
            'message' => $this->string(2048),
            'tries' => $this->integer()->notNull()->defaultValue(0),
            'created' => $this->dateTime()->defaultExpression('NOW()'),
            'executed' => $this->dateTime(),
            'updated' => $this->dateTime(),
        ], 'charset=utf8');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('queue_tasks');
    }
}
