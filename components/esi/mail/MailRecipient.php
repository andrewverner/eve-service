<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.10.18
 * Time: 9:15
 */

namespace app\components\esi\mail;

use app\components\esi\alliance\Alliance;
use app\components\esi\character\Character;
use app\components\esi\components\EVEObject;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;

class MailRecipient extends EVEObject
{
    const TYPE_ALLIANCE = 'alliance';
    const TYPE_CHARACTER = 'character';
    const TYPE_CORPORATION = 'corporation';
    const TYPE_MAILING_LIST = 'mailing_list';

    /**
     * @var int
     */
    public $recipientId;

    /**
     * @var string
     */
    public $recipientType;

    /**
     * @var Character|Corporation|Alliance
     */
    private $recipient;

    public function recipient()
    {
        if (!$this->recipient) {
            switch ($this->recipientType) {
                case self::TYPE_CHARACTER:
                    $this->recipient = EVE::character($this->recipientId);
                    break;
                case self::TYPE_CORPORATION:
                    $this->recipient = EVE::corporation($this->recipientId);
                    break;
                case self::TYPE_ALLIANCE:
                    $this->recipient = EVE::alliance($this->recipientId);
                    break;
                default:
                    $this->recipient = false;
            }
        }

        return $this->recipient;
    }
}
