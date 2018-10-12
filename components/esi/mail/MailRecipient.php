<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 12.10.18
 * Time: 9:15
 */

namespace app\components\esi\mail;

use app\components\esi\components\EVEObject;
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

    public function recipient()
    {
        switch ($this->recipientType) {
            case self::TYPE_CHARACTER:
                return EVE::character($this->recipientId);
                break;
            case self::TYPE_CORPORATION:
                return false;
                break;
            case self::TYPE_ALLIANCE:
                return false;
                break;
            default:
                return false;
        }
    }
}
