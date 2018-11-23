<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pi_planet`.
 */
class m181123_060447_create_pi_planet_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_planet', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'type_name' => $this->string()->notNull(),
            'mask' => $this->integer()->notNull(),
        ]);

        /*
        Planet (Temperate): 11
        Planet (Ice): 12
        Planet (Gas): 13
        Planet (Oceanic): 2014
        Planet (Lava): 2015
        Planet (Barren): 2016
        Planet (Storm): 2017
        Planet (Plasma): 2063
        */
        $data = [
            [
                'type_id' => 11,
                'type_name' => 'Planet (Temperate)',
                'mask' => 1,
            ],[
                'type_id' => 12,
                'type_name' => 'Planet (Ice)',
                'mask' => 2,
            ],[
                'type_id' => 13,
                'type_name' => 'Planet (Gas)',
                'mask' => 4,
            ],[
                'type_id' => 2014,
                'type_name' => 'Planet (Oceanic)',
                'mask' => 8,
            ],[
                'type_id' => 2015,
                'type_name' => 'Planet (Lava)',
                'mask' => 16,
            ],[
                'type_id' => 2016,
                'type_name' => 'Planet (Barren)',
                'mask' => 32,
            ],[
                'type_id' => 2017,
                'type_name' => 'Planet (Storm)',
                'mask' => 64,
            ],[
                'type_id' => 2063,
                'type_name' => 'Planet (Plasma)',
                'mask' => 128,
            ],
        ];

        foreach ($data as $row) {
            $this->insert('pi_planet', $row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_planet');
    }
}
