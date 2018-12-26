<?php

use yii\db\Migration;

/**
 * Class m181226_125218_rename_service_table
 */
class m181226_125218_rename_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('service', 'character_service');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('character_service', 'service');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181226_125218_rename_service_table cannot be reverted.\n";

        return false;
    }
    */
}
