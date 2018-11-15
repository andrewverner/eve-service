<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.11.18
 * Time: 8:24
 */

namespace app\components\esi\killmails;

class KillMailFitting
{
    /**
     * @var KillMailVictimItem[]
     */
    public $highSlots = [];

    /**
     * @var KillMailVictimItem[]
     */
    public $medSlots = [];

    /**
     * @var KillMailVictimItem[]
     */
    public $lowSlots = [];

    /**
     * @var KillMailVictimItem[]
     */
    public $rigSlots = [];

    /**
     * @var KillMailVictimItem[]
     */
    public $subsystemSlots = [];

    /**
     * @var KillMailVictimItem[]
     */
    public $droneBay = [];

    const CHARGES_GROUPS = [
        83,
        85,
        86,
        87,
        88,
        89,
        90,
        92,
        372,
        373,
        374,
        375,
        376,
        377,
        384,
        385,
        386,
        387,
        394,
        395,
        396,
        425,
        476,
        479,
        482,
        492,
        497,
        498,
        500,
        548,
        648,
        653,
        654,
        655,
        656,
        657,
        663,
        772,
        863,
        864,
        892,
        907,
        908,
        909,
        910,
        911,
        916,
        972,
        1010,
        1019,
        1153,
        1158,
        1400,
        1546,
        1547,
        1548,
        1549,
        1550,
        1551,
        1559,
        1569,
        1677,
        1678,
        1701,
        1702,
        1769,
        1771,
        1772,
        1773,
        1774,
        1976,
        1987,
        1989
    ];

    /**
     * KillMailFitting constructor.
     * @param KillMailVictimItem[] $items
     */
    public function __construct(array $items)
    {
        $items = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, array_merge(
                KillMailVictimItem::LOW_SLOTS,
                KillMailVictimItem::MED_SLOTS,
                KillMailVictimItem::HIGH_SLOTS,
                KillMailVictimItem::RIG_SLOTS,
                KillMailVictimItem::SUBSYSTEM_SLOTS,
                [KillMailVictimItem::FLAG_DRONE_BAY]
            ));
        });

        $this->highSlots = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, KillMailVictimItem::HIGH_SLOTS) && !in_array($item->type()->groupId, self::CHARGES_GROUPS);
        });
        $this->medSlots = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, KillMailVictimItem::MED_SLOTS);
        });
        $this->lowSlots = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, KillMailVictimItem::LOW_SLOTS);
        });
        $this->subsystemSlots = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, KillMailVictimItem::SUBSYSTEM_SLOTS);
        });
        $this->rigSlots = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return in_array($item->flag, KillMailVictimItem::RIG_SLOTS);
        });
        $this->droneBay = array_filter($items, function ($item) {
            /**
             * @var $item KillMailVictimItem
             */
            return $item->flag == KillMailVictimItem::FLAG_DRONE_BAY;
        });
    }
}
