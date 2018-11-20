<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:16
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\pi\Planetary;
use yii\helpers\Html;

class SolarSystem extends EVEObject
{
    /**
     * @var int
     */
    public $constellationId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var array
     */
    public $planets;

    /**
     * @var array
     */
    public $position;

    /**
     * @var string
     */
    public $securityClass;

    /**
     * @var float
     */
    public $securityStatus;

    /**
     * @var int
     */
    public $starId;

    /**
     * @var array
     */
    public $stargates;

    /**
     * @var array
     */
    public $stations;

    /**
     * @var int
     */
    public $systemId;

    /**
     * @var Planet[]
     */
    public $planetsList;

    const COLOR_NULL = '#ff0000';
    const COLOR_LOW = '#ff5e00';
    const COLOR_MEDIUM = '#efff00';
    const COLOR_ABOVE_MEDIUM = '#00ff37';
    const COLOR_HIGH = '#00ffe7';

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @return Planet[]
     */
    public function planets()
    {
        if (!$this->planetsList) {
            foreach ($this->planets as $planet) {
                $this->planetsList[] = new Planet($planet);
            }
        }

        return $this->planetsList;
    }

    public function getFormattedSecurityStatus($withColor = false)
    {
        $ss = number_format(round($this->securityStatus, 1), 1, '.', ' ');
        if (!$withColor) {
            return $ss;
        }

        switch ($ss) {
            case 1:
            case 0.9:
                $color = self::COLOR_HIGH;
                break;
            case 0.8:
            case 0.7:
                $color = self::COLOR_ABOVE_MEDIUM;
                break;
            case 0.6:
            case 0.5:
                $color = self::COLOR_MEDIUM;
                break;
            case 0.4:
            case 0.3:
            case 0.2:
                $color = self::COLOR_LOW;
                break;
            default:
                $color = self::COLOR_NULL;
        }

        return Html::tag('span', $ss, ['style' => "color:{$color}"]);
    }
}
