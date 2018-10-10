<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 10.10.2018
 * Time: 22:25
 */

namespace app\components\esi\location;

use \app\components\esi\components\EVEObject;

class CharacterLocation extends EVEObject
{
    /**
     * @var int
     */
    public $solarSystemId;

    /**
     * @var int
     */
    public $stationId;

    /**
     * @var int
     */
    public $structureId;
}
