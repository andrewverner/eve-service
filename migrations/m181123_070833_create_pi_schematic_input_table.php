<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pi_schematic_input`.
 */
class m181123_070833_create_pi_schematic_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_schematic_input', [
            'id' => $this->primaryKey(),
            'output_type_id' => $this->integer()->notNull(),
            'input_type_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
        ], 'charset=utf8');

        $data = [
            [
                'output_type_id' => 3683,
                'input_type_id' => 2310,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2399,
                'input_type_id' => 2270,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2397,
                'input_type_id' => 2305,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2400,
                'input_type_id' => 2272,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2389,
                'input_type_id' => 2308,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2401,
                'input_type_id' => 2306,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2392,
                'input_type_id' => 2311,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2393,
                'input_type_id' => 2073,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2390,
                'input_type_id' => 2309,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 3779,
                'input_type_id' => 2286,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2398,
                'input_type_id' => 2267,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2396,
                'input_type_id' => 2288,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2395,
                'input_type_id' => 2287,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 9828,
                'input_type_id' => 2307,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 3645,
                'input_type_id' => 2268,
                'quantity' => 3000,
            ],
            [
                'output_type_id' => 2319,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2319,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2312,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2312,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2463,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2463,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3693,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3693,
                'input_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9836,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9836,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2321,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2321,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 44,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 44,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2327,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2327,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2329,
                'input_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2329,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9842,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9842,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9838,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9838,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3695,
                'input_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3695,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 15317,
                'input_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 15317,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9840,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9840,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3775,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3775,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3691,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3691,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3689,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3689,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9830,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9830,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3828,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3828,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2328,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2328,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2317,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2317,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9832,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9832,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3697,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3697,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2329,
                'input_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2329,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3828,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3828,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9836,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9836,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9832,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9832,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 44,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 44,
                'input_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3693,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3693,
                'input_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 15317,
                'input_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 15317,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3725,
                'input_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3725,
                'input_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3689,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3689,
                'input_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2327,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2327,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9842,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9842,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2463,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2463,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2317,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2317,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2321,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2321,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3695,
                'input_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3695,
                'input_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9830,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9830,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3697,
                'input_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3697,
                'input_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9838,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9838,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2312,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2312,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3691,
                'input_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3691,
                'input_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2319,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2319,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9840,
                'input_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9840,
                'input_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3775,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3775,
                'input_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2328,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2328,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2358,
                'input_type_id' => 2463,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2358,
                'input_type_id' => 3725,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2358,
                'input_type_id' => 3828,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2345,
                'input_type_id' => 3697,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2345,
                'input_type_id' => 9830,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2344,
                'input_type_id' => 2317,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2344,
                'input_type_id' => 9832,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2367,
                'input_type_id' => 2319,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2367,
                'input_type_id' => 3691,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2367,
                'input_type_id' => 3693,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17392,
                'input_type_id' => 2312,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17392,
                'input_type_id' => 2327,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2348,
                'input_type_id' => 2317,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2348,
                'input_type_id' => 2329,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2348,
                'input_type_id' => 9838,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9834,
                'input_type_id' => 2328,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9834,
                'input_type_id' => 9840,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2366,
                'input_type_id' => 3695,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2366,
                'input_type_id' => 3775,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2366,
                'input_type_id' => 9840,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2361,
                'input_type_id' => 2321,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2361,
                'input_type_id' => 15317,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17898,
                'input_type_id' => 2321,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17898,
                'input_type_id' => 9840,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2360,
                'input_type_id' => 3693,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2360,
                'input_type_id' => 3695,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2354,
                'input_type_id' => 2329,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2354,
                'input_type_id' => 3697,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2352,
                'input_type_id' => 44,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2352,
                'input_type_id' => 2327,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9846,
                'input_type_id' => 2312,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9846,
                'input_type_id' => 3689,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9846,
                'input_type_id' => 9842,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9848,
                'input_type_id' => 3689,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 9848,
                'input_type_id' => 9836,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2351,
                'input_type_id' => 3828,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2351,
                'input_type_id' => 9842,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2349,
                'input_type_id' => 2328,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2349,
                'input_type_id' => 9832,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2349,
                'input_type_id' => 9836,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2346,
                'input_type_id' => 2312,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2346,
                'input_type_id' => 2319,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 12836,
                'input_type_id' => 2329,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 12836,
                'input_type_id' => 2463,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17136,
                'input_type_id' => 3691,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 17136,
                'input_type_id' => 9838,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 28974,
                'input_type_id' => 3725,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 28974,
                'input_type_id' => 3775,
                'quantity' => 10,
            ],
            [
                'output_type_id' => 2867,
                'input_type_id' => 2354,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2867,
                'input_type_id' => 17392,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2867,
                'input_type_id' => 17898,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2868,
                'input_type_id' => 2348,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2868,
                'input_type_id' => 2366,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2868,
                'input_type_id' => 9846,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2869,
                'input_type_id' => 2360,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2869,
                'input_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2869,
                'input_type_id' => 17136,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2870,
                'input_type_id' => 2344,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2870,
                'input_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2870,
                'input_type_id' => 9848,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2871,
                'input_type_id' => 2346,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2871,
                'input_type_id' => 9834,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2871,
                'input_type_id' => 12836,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2872,
                'input_type_id' => 2345,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2872,
                'input_type_id' => 2352,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2872,
                'input_type_id' => 2361,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2875,
                'input_type_id' => 2351,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2875,
                'input_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2875,
                'input_type_id' => 28974,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2876,
                'input_type_id' => 2349,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2876,
                'input_type_id' => 2358,
                'quantity' => 6,
            ],
            [
                'output_type_id' => 2876,
                'input_type_id' => 2367,
                'quantity' => 6,
            ],
        ];

        foreach ($data as $row) {
            $this->insert('pi_schematic_input', $row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_schematic_input');
    }
}
