<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pi_commodity`.
 */
class m181122_142554_create_pi_commodity_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_commodity', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->notNull(),
            'level' => $this->integer(1)->notNull()->defaultValue(0),
        ], 'charset=utf8');

        $data = [
            [
                'type_id' => 2310,
                'level' => 0,
            ],
            [
                'type_id' => 2270,
                'level' => 0,
            ],
            [
                'type_id' => 2305,
                'level' => 0,
            ],
            [
                'type_id' => 2272,
                'level' => 0,
            ],
            [
                'type_id' => 2308,
                'level' => 0,
            ],
            [
                'type_id' => 2306,
                'level' => 0,
            ],
            [
                'type_id' => 2311,
                'level' => 0,
            ],
            [
                'type_id' => 2073,
                'level' => 0,
            ],
            [
                'type_id' => 2309,
                'level' => 0,
            ],
            [
                'type_id' => 2286,
                'level' => 0,
            ],
            [
                'type_id' => 2267,
                'level' => 0,
            ],
            [
                'type_id' => 2288,
                'level' => 0,
            ],
            [
                'type_id' => 2287,
                'level' => 0,
            ],
            [
                'type_id' => 2307,
                'level' => 0,
            ],
            [
                'type_id' => 2268,
                'level' => 0,
            ],
            [
                'type_id' => 3683,
                'level' => 1,
            ],
            [
                'type_id' => 2399,
                'level' => 1,
            ],
            [
                'type_id' => 2397,
                'level' => 1,
            ],
            [
                'type_id' => 2400,
                'level' => 1,
            ],
            [
                'type_id' => 2389,
                'level' => 1,
            ],
            [
                'type_id' => 2401,
                'level' => 1,
            ],
            [
                'type_id' => 2392,
                'level' => 1,
            ],
            [
                'type_id' => 2393,
                'level' => 1,
            ],
            [
                'type_id' => 2390,
                'level' => 1,
            ],
            [
                'type_id' => 3779,
                'level' => 1,
            ],
            [
                'type_id' => 2398,
                'level' => 1,
            ],
            [
                'type_id' => 2396,
                'level' => 1,
            ],
            [
                'type_id' => 2395,
                'level' => 1,
            ],
            [
                'type_id' => 9828,
                'level' => 1,
            ],
            [
                'type_id' => 3645,
                'level' => 1,
            ],
            [
                'type_id' => 2319,
                'level' => 2,
            ],
            [
                'type_id' => 2312,
                'level' => 2,
            ],
            [
                'type_id' => 2463,
                'level' => 2,
            ],
            [
                'type_id' => 3693,
                'level' => 2,
            ],
            [
                'type_id' => 9836,
                'level' => 2,
            ],
            [
                'type_id' => 2321,
                'level' => 2,
            ],
            [
                'type_id' => 44,
                'level' => 2,
            ],
            [
                'type_id' => 2327,
                'level' => 2,
            ],
            [
                'type_id' => 2329,
                'level' => 2,
            ],
            [
                'type_id' => 9842,
                'level' => 2,
            ],
            [
                'type_id' => 9838,
                'level' => 2,
            ],
            [
                'type_id' => 3695,
                'level' => 2,
            ],
            [
                'type_id' => 15317,
                'level' => 2,
            ],
            [
                'type_id' => 9840,
                'level' => 2,
            ],
            [
                'type_id' => 3775,
                'level' => 2,
            ],
            [
                'type_id' => 3691,
                'level' => 2,
            ],
            [
                'type_id' => 3689,
                'level' => 2,
            ],
            [
                'type_id' => 9830,
                'level' => 2,
            ],
            [
                'type_id' => 3828,
                'level' => 2,
            ],
            [
                'type_id' => 2328,
                'level' => 2,
            ],
            [
                'type_id' => 2317,
                'level' => 2,
            ],
            [
                'type_id' => 9832,
                'level' => 2,
            ],
            [
                'type_id' => 3697,
                'level' => 2,
            ],
            [
                'type_id' => 3725,
                'level' => 2,
            ],
            [
                'type_id' => 2358,
                'level' => 3,
            ],
            [
                'type_id' => 2367,
                'level' => 3,
            ],
            [
                'type_id' => 2352,
                'level' => 3,
            ],
            [
                'type_id' => 2344,
                'level' => 3,
            ],
            [
                'type_id' => 9846,
                'level' => 3,
            ],
            [
                'type_id' => 2349,
                'level' => 3,
            ],
            [
                'type_id' => 17136,
                'level' => 3,
            ],
            [
                'type_id' => 2360,
                'level' => 3,
            ],
            [
                'type_id' => 2354,
                'level' => 3,
            ],
            [
                'type_id' => 17898,
                'level' => 3,
            ],
            [
                'type_id' => 28974,
                'level' => 3,
            ],
            [
                'type_id' => 2366,
                'level' => 3,
            ],
            [
                'type_id' => 2351,
                'level' => 3,
            ],
            [
                'type_id' => 12836,
                'level' => 3,
            ],
            [
                'type_id' => 2346,
                'level' => 3,
            ],
            [
                'type_id' => 17392,
                'level' => 3,
            ],
            [
                'type_id' => 9848,
                'level' => 3,
            ],
            [
                'type_id' => 2361,
                'level' => 3,
            ],
            [
                'type_id' => 9834,
                'level' => 3,
            ],
            [
                'type_id' => 2345,
                'level' => 3,
            ],
            [
                'type_id' => 2348,
                'level' => 3,
            ],
            [
                'type_id' => 2867,
                'level' => 4,
            ],
            [
                'type_id' => 2868,
                'level' => 4,
            ],
            [
                'type_id' => 2871,
                'level' => 4,
            ],
            [
                'type_id' => 2875,
                'level' => 4,
            ],
            [
                'type_id' => 2876,
                'level' => 4,
            ],
            [
                'type_id' => 2869,
                'level' => 4,
            ],
            [
                'type_id' => 2870,
                'level' => 4,
            ],
            [
                'type_id' => 2872,
                'level' => 4,
            ],
        ];

        foreach ($data as $row) {
            $this->insert('pi_commodity', $row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_commodity');
    }
}
