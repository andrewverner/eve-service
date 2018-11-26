<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 11:58
 */

namespace app\components\esi\character;

use app\components\esi\components\EVEObject;

class Notification extends EVEObject
{
    const SENDER_TYPE_CORPORATION = 'corporation';
    const SENDER_TYPE_CHARACTER   = 'character';
    const SENDER_TYPE_ALLIANCE    = 'alliance';
    const SENDER_TYPE_FACTION     = 'faction';
    const SENDER_TYPE_OTHER       = 'other';

    /**
     * @var bool
     */
    public $isRead;

    /**
     * @var int
     */
    public $notificationId;

    /**
     * @var int
     */
    public $senderId;

    /**
     * @var string
     */
    public $senderType;

    /**
     * @var string
     */
    public $text;

    /**
     * @var \DateTime
     */
    public $timestamp;

    /**
     * @var string
     */
    public $type;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->timestamp = new \DateTime($this->timestamp);
    }

    public function getText()
    {
        $className = "app\components\\esi\\notifications\\$this->type";
        if (!class_exists($className)) {
            return print_r(yaml_parse($this->text), true);
        }

        return (new $className($this->text))->parse();
    }
}
