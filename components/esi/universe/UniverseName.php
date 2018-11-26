<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 17:15
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class UniverseName extends EVEObject
{
    const CATEGORY_INVENTORY_TYPE = 'inventory_type';
    const CATEGORY_CONSTELLATION  = 'constellation';
    const CATEGORY_SOLAR_SYSTEM   = 'solar_system';
    const CATEGORY_CORPORATION    = 'corporation';
    const CATEGORY_CHARACTER      = 'character';
    const CATEGORY_ALLIANCE       = 'alliance';
    const CATEGORY_STATION        = 'station';
    const CATEGORY_REGION         = 'region';

    /**
     * @var string
     */
    public $category;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @return \app\components\esi\alliance\Alliance|\app\components\esi\corporation\Corporation|null
     */
    public function model()
    {
       switch ($this->category) {
           case self::CATEGORY_ALLIANCE:
               return EVE::alliance($this->id);
               break;
           case self::CATEGORY_CORPORATION:
               return EVE::corporation($this->id);
               break;
           default:
               return null;
               break;
       }
    }
}
