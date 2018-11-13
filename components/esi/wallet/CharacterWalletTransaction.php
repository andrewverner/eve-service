<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 17:06
 */

namespace app\components\esi\wallet;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\Station;
use app\components\esi\universe\Type;

class CharacterWalletTransaction extends EVEObject
{
    /**
     * @var int
     */
    public $clientId;

    /**
     * @var \DateTime
     */
    public $date;

    /**
     * @var bool
     */
    public $isBuy;

    /**
     * @var bool
     */
    public $isPersonal;

    /**
     * @var int
     */
    public $journalRefId;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var int
     */
    public $quantity;

    /**
     * @var int
     */
    public $transactionId;

    /**
     * @var int
     */
    public $typeId;

    /**
     * @var float
     */
    public $unitPrice;

    /**
     * @var Type
     */
    private $type;

    /**
     * @var Station
     */
    private $location;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->date = new \DateTime($this->date);
    }

    /**
     * @return Type
     */
    public function type()
    {
        if (!$this->type) {
            $this->type = EVE::universe()->type($this->typeId);
        }

        return $this->type;
    }

    /**
     * @return Station
     */
    public function location()
    {
        if (!$this->location) {
            $this->location = EVE::universe()->station($this->locationId);
        }

        return $this->location;
    }
}
