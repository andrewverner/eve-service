<?php

namespace app\components\esi\calendar;

use app\components\esi\components\EVEObject;
use DateTime;

class CharacterCalendarEvent extends EVEObject
{
    /**
     * @var DateTime
     */
    public $date;

    /**
     * @var int
     */
    public $duration;

    /**
     * @var int
     */
    public $eventId;

    /**
     * @var int
     */
    public $importance;

    /**
     * @var int
     */
    public $ownerId;

    /**
     * @var string
     */
    public $ownerName;

    /**
     * @var string
     */
    public $ownerType;

    /**
     * @var string
     */
    public $response;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $title;

    /**
     * @var CharacterCalendarEventOwner
     */
    private $owner;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->date = new DateTime($this->date);
    }

    /**
     * @return CharacterCalendarEventOwner
     */
    public function getOwner()
    {
        if (!$this->owner) {
            $this->owner = new CharacterCalendarEventOwner($this);
        }

        return $this->owner;
    }
}
