<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 17:38
 */

namespace app\components\esi\notifications;

use app\components\esi\components\EVEObject;
use app\components\esi\helpers\EVEFormatter;

class InsurancePayoutMsg extends EVEObject
{
    /**
     * @var float
     */
    public $amount;

    /**
     * @var int
     */
    public $itemID;

    /**
     * @var int
     */
    public $payout;

    public function __construct($yaml)
    {
        $data = yaml_parse($yaml);
        parent::__construct($data);
    }

    public function parse()
    {
        #$type = EVE::universe()->type($this->itemID);
        $amount = EVEFormatter::isk($this->amount);

        return "Insurance payout for : {$amount} ISK";
    }
}
