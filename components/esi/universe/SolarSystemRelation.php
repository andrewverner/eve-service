<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.06.19
 * Time: 13:03
 */

namespace app\components\esi\universe;

use app\components\esi\helpers\EVEFormatter;

class SolarSystemRelation
{
    const COLOR_NULL = '#ff0000';
    const COLOR_LOW = '#ff5e00';
    const COLOR_MEDIUM = '#efff00';
    const COLOR_ABOVE_MEDIUM = '#00ff37';
    const COLOR_HIGH = '#00ffe7';

    /**
     * @var SolarSystem
     */
    public $from;

    /**
     * @var SolarSystem
     */
    public $to;

    /**
     * @var float
     */
    public $securityStatus;

    public function __construct(SolarSystem $from, SolarSystem $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->securityStatus = EVEFormatter::securityStatus(($from->securityStatus + $to->securityStatus)/2);
    }

    public function getColor()
    {
        if ($this->securityStatus < 0.2) {
            return self::COLOR_NULL;
        } elseif ($this->securityStatus >= 0.2 && $this->securityStatus < 0.5) {
            return self::COLOR_LOW;
        } elseif ($this->securityStatus >= 0.5 && $this->securityStatus < 0.7) {
            return self::COLOR_MEDIUM;
        } elseif ($this->securityStatus >= 0.7 && $this->securityStatus < 0.9) {
            return self::COLOR_ABOVE_MEDIUM;
        } else {
            return self::COLOR_HIGH;
        }
    }
}
