<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.10.18
 * Time: 10:38
 */

namespace app\components\esi\calendar;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\models\Token;
use DateTime;

class CharacterCalendar extends EVEObject
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

    /**
     * @var Token;
     */
    private $token;

    /**
     * @var CharacterCalendarEvent
     */
    private $event;

    public function __construct(array $data, Token $token)
    {
        parent::__construct($data);
        $this->eventDate = new DateTime($this->eventDate);
        $this->token = $token;
    }

    /**
     * @return CharacterCalendarEvent
     */
    public function getEvent()
    {
        if (!$this->event) {
            $request = EVE::secureRequest('/characters/{character_id}/calendar/{event_id}/', $this->token);
            $event = $request->send(['character_id' => $this->token->character_id, 'event_id' => $this->eventId]);

            $this->event = new CharacterCalendarEvent($event);
        }

        return $this->event;
    }
}
