<?php

use yii\db\Migration;

/**
 * Class m181123_060509_create_pi_planet_commodity
 */
class m181123_060509_create_pi_planet_commodity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_planet_commodity', [
            'id' => $this->primaryKey(),
            'planet_type_id' => $this->integer()->notNull(),
            'commodity_type_id' => $this->integer()->notNull(),
        ], 'charset=utf8');

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
                'planet_type_id' => 2016,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 2016,
                'commodity_type_id' => 2267,
            ],
            [
                'planet_type_id' => 2016,
                'commodity_type_id' => 2288,
            ],
            [
                'planet_type_id' => 2016,
                'commodity_type_id' => 2073,
            ],
            [
                'planet_type_id' => 2016,
                'commodity_type_id' => 2270,
            ],
            [
                'planet_type_id' => 13,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 13,
                'commodity_type_id' => 2267,
            ],
            [
                'planet_type_id' => 13,
                'commodity_type_id' => 2309,
            ],
            [
                'planet_type_id' => 13,
                'commodity_type_id' => 2310,
            ],
            [
                'planet_type_id' => 13,
                'commodity_type_id' => 2311,
            ],
            [
                'planet_type_id' => 12,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 12,
                'commodity_type_id' => 2272,
            ],
            [
                'planet_type_id' => 12,
                'commodity_type_id' => 2073,
            ],
            [
                'planet_type_id' => 12,
                'commodity_type_id' => 2310,
            ],
            [
                'planet_type_id' => 12,
                'commodity_type_id' => 2286,
            ],
            [
                'planet_type_id' => 2015,
                'commodity_type_id' => 2267,
            ],
            [
                'planet_type_id' => 2015,
                'commodity_type_id' => 2307,
            ],
            [
                'planet_type_id' => 2015,
                'commodity_type_id' => 2272,
            ],
            [
                'planet_type_id' => 2015,
                'commodity_type_id' => 2306,
            ],
            [
                'planet_type_id' => 2015,
                'commodity_type_id' => 2308,
            ],
            [
                'planet_type_id' => 2014,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 2014,
                'commodity_type_id' => 2288,
            ],
            [
                'planet_type_id' => 2014,
                'commodity_type_id' => 2287,
            ],
            [
                'planet_type_id' => 2014,
                'commodity_type_id' => 2073,
            ],
            [
                'planet_type_id' => 2014,
                'commodity_type_id' => 2286,
            ],
            [
                'planet_type_id' => 2063,
                'commodity_type_id' => 2267,
            ],
            [
                'planet_type_id' => 2063,
                'commodity_type_id' => 2272,
            ],
            [
                'planet_type_id' => 2063,
                'commodity_type_id' => 2270,
            ],
            [
                'planet_type_id' => 2063,
                'commodity_type_id' => 2306,
            ],
            [
                'planet_type_id' => 2063,
                'commodity_type_id' => 2308,
            ],
            [
                'planet_type_id' => 2017,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 2017,
                'commodity_type_id' => 2267,
            ],
            [
                'planet_type_id' => 2017,
                'commodity_type_id' => 2309,
            ],
            [
                'planet_type_id' => 2017,
                'commodity_type_id' => 2310,
            ],
            [
                'planet_type_id' => 2017,
                'commodity_type_id' => 2308,
            ],
            [
                'planet_type_id' => 11,
                'commodity_type_id' => 2268,
            ],
            [
                'planet_type_id' => 11,
                'commodity_type_id' => 2305,
            ],
            [
                'planet_type_id' => 11,
                'commodity_type_id' => 2288,
            ],
            [
                'planet_type_id' => 11,
                'commodity_type_id' => 2287,
            ],
            [
                'planet_type_id' => 11,
                'commodity_type_id' => 2073,
            ],
        ];

        foreach ($data as $row) {
            $this->insert('pi_planet_commodity', $row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_planet_commodity');
    }
}
