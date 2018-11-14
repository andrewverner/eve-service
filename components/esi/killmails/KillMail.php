<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 14.11.18
 * Time: 8:53
 */

namespace app\components\esi\killmails;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;
use yii\web\NotFoundHttpException;

class KillMail extends EVEObject
{
    /**
     * @var string
     */
    public $killmailHash;

    /**
     * @var int
     */
    public $killmailId;

    /**
     * @var KillMailAttacker[]
     */
    public $attackers;

    /**
     * @var \DateTime
     */
    public $killmailTime;

    /**
     * @var int
     */
    public $moonId;

    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var KillMailVictim
     */
    public $victim;

    /**
     * @var int
     */
    public $warId;

    /**
     * @var SolarSystem
     */
    private $solarSystem;

    /**
     * @var float
     */
    private $lostCost;

    /**
     * KillMail constructor.
     * @param array $data
     * @throws NotFoundHttpException
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $cacheKey = "killmail:{$this->killmailId}:{$this->killmailHash}";
        $killMailDataRequest = EVE::request('/killmails/{killmail_id}/{killmail_hash}/');
        $killMailDataRequest->cacheDuration = 1209600;
        $killMailData = $killMailDataRequest->send([
            'killmail_id' => $this->killmailId,
            'killmail_hash' => $this->killmailHash,
        ], $cacheKey);

        if (!$killMailData) {
            throw new NotFoundHttpException('Kill mail not found');
        }

        parent::__construct($killMailData);

        $this->killmailTime = new \DateTime($this->killmailTime);
        foreach ($this->attackers as &$attacker) {
            $attacker = new KillMailAttacker($attacker);
        }
        $this->victim = new KillMailVictim($this->victim);
    }

    /**
     * @return SolarSystem
     */
    public function solarSystem()
    {
        if (!$this->solarSystem) {
            $this->solarSystem = EVE::universe()->solarSystem($this->solarSystemId);
        }

        return $this->solarSystem;
    }

    /**
     * @return float|int
     */
    public function lossCost()
    {
        if (!$this->lostCost) {
            $this->lostCost += EVE::market()->getPrice($this->victim->shipTypeId);
        }

        foreach ($this->victim->items as $item) {
            $this->lostCost += EVE::market()->getPrice($item->itemTypeId) * ($item->quantityDestroyed + $item->quantityDropped);
        }

        return $this->lostCost;
    }
}
