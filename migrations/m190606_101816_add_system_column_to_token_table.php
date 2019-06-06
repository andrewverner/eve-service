<?php

use yii\db\Migration;

/**
 * Handles adding system to table `{{%token}}`.
 */
class m190606_101816_add_system_column_to_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Token::tableName(), 'system', $this->tinyInteger(1)->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Token::tableName(), 'system');
    }
}
