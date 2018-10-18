<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.10.18
 * Time: 10:38
 */

namespace app\components\esi\calendar;

use app\components\esi\components\EVEObject;

class CharacterCalendarEvent extends EVEObject
{
    const EVENT_RESPONSE_NOT_RESPONDED = 'not_responded';
    const EVENT_RESPONSE_TENTATIVE     = 'tentative';
    const EVENT_RESPONSE_DECLINED      = 'declined';
    const EVENT_RESPONSE_ACCEPTED      = 'accepted';

    /**
     * @var \DateTime
     */
    public $eventDate;

    /**
     * @var int
     */
    public $eventId;

    /**
     * @var string
     */
    public $eventResponse;

    /**
     * @var int
     */
    public $importance;

    /**
     * @var string
     */
    public $title;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->eventDate = new \DateTime($this->eventDate);
    }
}
