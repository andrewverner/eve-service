<?php

use yii\db\Migration;

/**
 * Handles adding hash to table `character_route`.
 */
class m181103_145120_add_hash_column_to_character_route_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(\app\models\CharacterRoute::tableName(), 'hash', $this->string(64));
        $this->addColumn(\app\models\CharacterRoute::tableName(), 'share', $this->tinyInteger(1)->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(\app\models\CharacterRoute::tableName(), 'hash');
        $this->dropColumn(\app\models\CharacterRoute::tableName(), 'share');
    }
}
