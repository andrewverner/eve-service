<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.11.18
 * Time: 8:50
 */

namespace app\components\esi\killmails;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class KillMailVictimItem extends EVEObject
{
    const FLAG_CARGO = 5;
    const FLAG_LOW_SLOT_1 = 11;
    const FLAG_LOW_SLOT_2 = 12;
    const FLAG_LOW_SLOT_3 = 13;
    const FLAG_LOW_SLOT_4 = 14;
    const FLAG_LOW_SLOT_5 = 15;
    const FLAG_LOW_SLOT_6 = 16;
    const FLAG_LOW_SLOT_7 = 17;
    const FLAG_LOW_SLOT_8 = 18;
    const FLAG_MED_SLOT_1 = 19;
    const FLAG_MED_SLOT_2 = 20;
    const FLAG_MED_SLOT_3 = 21;
    const FLAG_MED_SLOT_4 = 22;
    const FLAG_MED_SLOT_5 = 23;
    const FLAG_MED_SLOT_6 = 24;
    const FLAG_MED_SLOT_7 = 25;
    const FLAG_MED_SLOT_8 = 26;
    const FLAG_HIGH_SLOT_1 = 27;
    const FLAG_HIGH_SLOT_2 = 28;
    const FLAG_HIGH_SLOT_3 = 29;
    const FLAG_HIGH_SLOT_4 = 30;
    const FLAG_HIGH_SLOT_5 = 31;
    const FLAG_HIGH_SLOT_6 = 32;
    const FLAG_HIGH_SLOT_7 = 33;
    const FLAG_HIGH_SLOT_8 = 34;
    const FLAG_FIXED_SLOT = 35;
    const FLAG_DRONE_BAY = 87;
    const FLAG_SHIP_HANGAR = 90;
    const FLAG_RIG_SLOT_1 = 92;
    const FLAG_RIG_SLOT_2 = 93;
    const FLAG_RIG_SLOT_3 = 94;
    const FLAG_RIG_SLOT_4 = 95;
    const FLAG_RIG_SLOT_5 = 96;
    const FLAG_RIG_SLOT_6 = 97;
    const FLAG_RIG_SLOT_7 = 98;
    const FLAG_RIG_SLOT_8 = 99;
    const FLAG_SUBSYSTEM_SLOT_0 = 125;
    const FLAG_SUBSYSTEM_SLOT_1 = 126;
    const FLAG_SUBSYSTEM_SLOT_2 = 127;
    const FLAG_SUBSYSTEM_SLOT_3 = 128;
    const FLAG_SUBSYSTEM_SLOT_4 = 129;
    const FLAG_SUBSYSTEM_SLOT_5 = 130;
    const FLAG_SUBSYSTEM_SLOT_6 = 131;
    const FLAG_SUBSYSTEM_SLOT_7 = 132;
    const FLAG_FUEL_BAY = 133;
    const FLAG_ORE_HOLD = 134;
    const FLAG_GAS_HOLD = 135;
    const FLAG_MINERAL_HOLD = 136;
    const FLAG_SALVAGE_HOLD = 137;
    const FLAG_SHIP_HOLD = 138;
    const FLAG_SMALL_SHIP_HOLD = 139;
    const FLAG_MED_SHIP_HOLD = 140;
    const FLAG_LARGE_SHIP_HOLD = 141;
    const FLAG_INDUSTRIAL_SHIP_HOLD = 142;
    const FLAG_AMMO_HOLD = 143;
    const FLAG_COMMAND_CENTER_HOLD = 148;
    const FLAG_PLANETARY_COMMODITIES_HOLD = 149;
    const FLAG_MATERIAL_BAY = 151;
    const FLAG_FLEET_HANGAR = 155;
    const FLAG_FIGHTER_BAY = 158;
    const FLAG_FIGHTER_TUBE_0 = 159;
    const FLAG_FIGHTER_TUBE_1 = 160;
    const FLAG_FIGHTER_TUBE_2 = 161;
    const FLAG_FIGHTER_TUBE_3 = 162;
    const FLAG_FIGHTER_TUBE_4 = 163;
    const FLAG_SUBSYSTEM_HOLD = 177;

    const LOW_SLOTS = [
        self::FLAG_LOW_SLOT_1,
        self::FLAG_LOW_SLOT_2,
        self::FLAG_LOW_SLOT_3,
        self::FLAG_LOW_SLOT_4,
        self::FLAG_LOW_SLOT_5,
        self::FLAG_LOW_SLOT_6,
        self::FLAG_LOW_SLOT_7,
        self::FLAG_LOW_SLOT_8,
    ];

    const MED_SLOTS = [
        self::FLAG_MED_SLOT_1,
        self::FLAG_MED_SLOT_2,
        self::FLAG_MED_SLOT_3,
        self::FLAG_MED_SLOT_4,
        self::FLAG_MED_SLOT_5,
        self::FLAG_MED_SLOT_6,
        self::FLAG_MED_SLOT_7,
        self::FLAG_MED_SLOT_8,
    ];

    const HIGH_SLOTS = [
        self::FLAG_HIGH_SLOT_1,
        self::FLAG_HIGH_SLOT_2,
        self::FLAG_HIGH_SLOT_3,
        self::FLAG_HIGH_SLOT_4,
        self::FLAG_HIGH_SLOT_5,
        self::FLAG_HIGH_SLOT_6,
        self::FLAG_HIGH_SLOT_7,
        self::FLAG_HIGH_SLOT_8,
    ];

    const RIG_SLOTS = [
        self::FLAG_RIG_SLOT_1,
        self::FLAG_RIG_SLOT_2,
        self::FLAG_RIG_SLOT_3,
        self::FLAG_RIG_SLOT_4,
        self::FLAG_RIG_SLOT_5,
        self::FLAG_RIG_SLOT_6,
        self::FLAG_RIG_SLOT_7,
        self::FLAG_RIG_SLOT_8,
    ];

    const SUBSYSTEM_SLOTS = [
        self::FLAG_SUBSYSTEM_SLOT_0,
        self::FLAG_SUBSYSTEM_SLOT_1,
        self::FLAG_SUBSYSTEM_SLOT_2,
        self::FLAG_SUBSYSTEM_SLOT_3,
        self::FLAG_SUBSYSTEM_SLOT_4,
        self::FLAG_SUBSYSTEM_SLOT_5,
        self::FLAG_SUBSYSTEM_SLOT_6,
        self::FLAG_SUBSYSTEM_SLOT_7,
    ];

    /**
     * @var int
     */
    public $flag;

    /**
     * @var int
     */
    public $itemTypeId;

    /**
     * @var int
     */
    public $quantityDestroyed;

    /**
     * @var int
     */
    public $quantityDropped;

    /**
     * @var int
     */
    public $singleton;

    /**
     * @var Type
     */
    private $type;

    /**
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->itemTypeId);
        }

        return $this->type;
    }
}
