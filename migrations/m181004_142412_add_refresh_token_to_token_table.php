<?php

use yii\db\Migration;

/**
 * Class m181004_142412_add_refresh_token_to_token_table
 */
class m181004_142412_add_refresh_token_to_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\Token::tableName(), 'refresh_token', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\Token::tableName(), 'refresh_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181004_142412_add_refresh_token_to_token_table cannot be reverted.\n";

        return false;
    }
    */
}
