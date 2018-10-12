<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.10.18
 * Time: 12:07
 */

namespace app\components\esi\mail;

use app\components\esi\character\Character;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class MailBody extends EVEObject
{
    /**
     * @var string
     */
    public $body;

    /**
     * @var Character
     */
    public $from;

    /**
     * @var int[]
     */
    public $labels;

    /**
     * @var bool
     */
    public $read;

    /**
     * @var MailRecipient[]
     */
    public $recipient = [];

    /**
     * @var string
     */
    public $subject;

    /**
     * @var \DateTime
     */
    public $timestamp;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->timestamp = new \DateTime($this->timestamp);
        foreach ($this->recipient as &$recipient) {
            $recipient = new MailRecipient($recipient);
        }
        $this->from = EVE::character($this->from);
    }
}
