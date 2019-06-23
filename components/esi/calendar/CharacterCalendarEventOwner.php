<?php

namespace app\components\esi\calendar;

use app\components\esi\alliance\Alliance;
use app\components\esi\character\Character;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;
use app\components\esi\universe\EVEServer;
use app\components\esi\universe\Faction;
use stdClass;

class CharacterCalendarEventOwner
{
    const TYPE_FACTION     = 'faction';
    const TYPE_ALLIANCE    = 'alliance ';
    const TYPE_CHARACTER   = 'character';
    const TYPE_EVE_SERVER  = 'eve_server';
    const TYPE_CORPORATION = 'corporation';

    /**
     * @var Character|Corporation|Alliance|Faction|stdClass
     */
    private $owner;

    public function __construct(CharacterCalendarEvent $event)
    {
        switch ($event->ownerType) {
            case self::TYPE_CHARACTER:
                $this->owner = EVE::character($event->ownerId);
                break;
            case self::TYPE_CORPORATION:
                $this->owner = EVE::corporation($event->ownerId);
                break;
            case self::TYPE_ALLIANCE:
                $this->owner = EVE::alliance($event->ownerId);
                break;
            case self::TYPE_FACTION:
                $this->owner = EVE::universe()->faction($event->ownerId);
                break;
            default:
                $this->owner = new EVEServer();
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        if ($this->owner instanceof Character) {
            return 'Character';
        }

        if ($this->owner instanceof Corporation) {
            return 'Corporation';
        }

        if ($this->owner instanceof Alliance) {
            return 'Alliance';
        }

        if ($this->owner instanceof Faction) {
            return 'Faction';
        }

        return 'EVE Server';
    }

    /**
     * @param int $size
     *
     * @return string|null
     */
    public function getImage($size = 64)
    {
        if (
            $this->owner instanceof Character
            || $this->owner instanceof Corporation
            || $this->owner instanceof Alliance
            || $this->owner instanceof Faction
        ) {
            return $this->owner->image($size);
        }

        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->owner->name;
    }
}
