<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scope`.
 */
class m181004_111535_create_scope_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('scope', [
            'id' => $this->primaryKey(),
            'scope' => $this->string(255)->notNull(),
            'mask' => $this->integer(),
            'description' => $this->string(255),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'group_id' => $this->integer()
        ]);
        $this->addColumn(\app\models\Token::tableName(), 'scope_mask', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('scope');
    }
}
