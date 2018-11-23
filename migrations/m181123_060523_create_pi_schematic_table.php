<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pi_schematic`.
 */
class m181123_060523_create_pi_schematic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pi_schematic', [
            'id' => $this->primaryKey(),
            'output_type_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
        ]);

        $data = [
            [
                'output_type_id' => 3683,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2399,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2397,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2400,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2389,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2401,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2392,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2393,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2390,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3779,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2398,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2396,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2395,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 9828,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 3645,
                'quantity' => 40,
            ],
            [
                'output_type_id' => 2319,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2312,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2463,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3693,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9836,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2321,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 44,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2327,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2329,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9842,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9838,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3695,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 15317,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9840,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3775,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3691,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3689,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9830,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3828,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2328,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2317,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 9832,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3697,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 3725,
                'quantity' => 5,
            ],
            [
                'output_type_id' => 2358,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2367,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2352,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2344,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 9846,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2349,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 17136,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2360,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2354,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 17898,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 28974,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2366,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2351,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 12836,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2346,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 17392,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 9848,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2361,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 9834,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2345,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2348,
                'quantity' => 3,
            ],
            [
                'output_type_id' => 2867,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2868,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2871,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2875,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2876,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2869,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2870,
                'quantity' => 1,
            ],
            [
                'output_type_id' => 2872,
                'quantity' => 1,
            ],
        ];

        foreach ($data as $row) {
            $this->insert('pi_schematic', $row);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pi_schematic');
    }
}
