<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 16:52
 */

namespace app\components\esi\wallet;

use app\components\esi\components\EVEObject;

class CharacterWalletJournalRecord extends EVEObject
{
    const CONTEXT_ID_TYPE_MARKET_TRANSACTION_ID = 'market_transaction_id';
    const CONTEXT_ID_TYPE_INDUSTRY_JOB_ID       = 'industry_job_id';
    const CONTEXT_ID_TYPE_CORPORATION_ID        = 'corporation_id';
    const CONTEXT_ID_TYPE_CHARACTER_ID          = 'character_id';
    const CONTEXT_ID_TYPE_STRUCTURE_ID          = 'structure_id';
    const CONTEXT_ID_TYPE_ALLIANCE_ID           = 'alliance_id';
    const CONTEXT_ID_TYPE_CONTRACT_ID           = 'contract_id';
    const CONTEXT_ID_TYPE_EVE_SYSTEM            = 'eve_system';
    const CONTEXT_ID_TYPE_STATION_ID            = 'station_id';
    const CONTEXT_ID_TYPE_PLANET_ID             = 'planet_id';
    const CONTEXT_ID_TYPE_SYSTEM_ID             = 'system_id';
    const CONTEXT_ID_TYPE_TYPE_ID               = 'type_id';

    /**
     * @var float
     */
    public $amount;

    /**
     * @var float
     */
    public $balance;

    /**
     * @var int
     */
    public $contextId;

    /**
     * @var string
     */
    public $contextIdType;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $firstPartyId;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $reason;

    /**
     * @var string
     */
    public $refType;

    /**
     * @var int
     */
    public $secondPartyId;

    /**
     * @var float
     */
    public $tax;

    /**
     * @var int
     */
    public $taxReceiverId;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
    }
}
