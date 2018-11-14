<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.11.18
 * Time: 8:40
 */

namespace app\components\esi\killmails;

use app\components\esi\alliance\Alliance;
use app\components\esi\character\Character;
use app\components\esi\components\EVEObject;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;
use app\components\esi\universe\Type;

class KillMailAttacker extends EVEObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $characterId;

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var int
     */
    public $damageDone;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var bool
     */
    public $finalBlow;

    /**
     * @var float
     */
    public $securityStatus;

    /**
     * @var int
     */
    public $shipTypeId;

    /**
     * @var int
     */
    public $weaponTypeId;

    /**
     * @var Type
     */
    private $ship;

    /**
     * @var Type
     */
    private $weapon;

    /**
     * @var Character
     */
    private $character;

    /**
     * @var Corporation
     */
    private $corporation;

    /**
     * @var Alliance
     */
    private $alliance;

    /**
     * @return Character
     */
    public function character()
    {
        if (!$this->character) {
            $this->character = EVE::character($this->characterId);
        }

        return $this->character;
    }

    /**
     * @return Type
     */
    public function ship()
    {
        if (!$this->ship) {
            $this->ship = EVE::universe()->type($this->shipTypeId);
        }

        return $this->ship;
    }

    /**
     * @return Type
     */
    public function weapon()
    {
        if (!$this->weapon) {
            $this->weapon = EVE::universe()->type($this->weaponTypeId);
        }

        return $this->weapon;
    }

    /**
     * @return Corporation
     */
    public function corporation()
    {
        if (!$this->corporation) {
            $this->corporation = EVE::corporation($this->corporationId);
        }

        return $this->corporation;
    }

    /**
     * @return Alliance
     */
    public function alliance()
    {
        if (!$this->alliance) {
            $this->alliance = EVE::alliance($this->allianceId);
        }

        return $this->alliance;
    }
}
