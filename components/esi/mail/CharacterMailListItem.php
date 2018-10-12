<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.10.18
 * Time: 9:12
 */

namespace app\components\esi\mail;

use app\components\esi\components\EVEObject;

class CharacterMailListItem extends EVEObject
{
    /**
     * @var int
     */
    public $from;

    /**
     * @var bool
     */
    public $isRead;

    /**
     * @var array
     */
    public $labels;

    /**
     * @var int
     */
    public $mailId;

    /**
     * @var array
     */
    public $recipients = [];

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
        foreach ($this->recipients as &$recipient) {
            $recipient = new MailRecipient($recipient);
        }
    }
}
