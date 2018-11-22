<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.11.18
 * Time: 15:48
 */

namespace app\components\esi\character;

use app\components\esi\components\EVEObject;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;
use app\components\esi\helpers\EVEFormatter;
use app\components\esi\universe\Faction;

class Standing extends EVEObject
{
    const FROM_AGENT    = 'agent';
    const FROM_FACTION  = 'faction';
    const FROM_NPC_CORP = 'npc_corp';

    /**
     * @var int
     */
    public $fromId;

    /**
     * @var string
     */
    public $fromType;

    /**
     * @var float
     */
    public $standing;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->standing = EVEFormatter::standing($this->standing);
    }

    /**
     * @var Character|Corporation
     */
    private $from;

    /**
     * @return Character|Corporation|Faction|null
     * @throws \yii\web\NotFoundHttpException
     */
    public function from()
    {
        if (!$this->from) {
            if ($this->fromType == self::FROM_AGENT) {
                try {
                    $this->from = EVE::character($this->fromId);
                } catch (\Exception $exception) {
                    return null;
                }
            } elseif ($this->fromType == self::FROM_NPC_CORP) {
                $this->from = EVE::corporation($this->fromId);
            } else {
                $this->from = EVE::universe()->faction($this->fromId);
            }
        }

        return $this->from;
    }
}
