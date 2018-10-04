<?php

use yii\db\Migration;

/**
 * Class m181004_194222_alter_refresh_token_column
 */
class m181004_194222_alter_refresh_token_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn(\app\models\Token::tableName(), 'refresh_token', $this->string(512));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181004_194222_alter_refresh_token_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181004_194222_alter_refresh_token_column cannot be reverted.\n";

        return false;
    }
    */
}
