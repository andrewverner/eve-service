<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 12:25
 */

namespace app\components\esi\universe;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class IdsFactory extends EVEObject
{
    public $agents;
    public $alliances;
    public $characters;
    public $constellations;
    public $corporations;
    public $factions;

    /**
     * @var Type[]
     */
    public $inventoryTypes;
    public $regions;
    public $stations;
    public $systems;

    public function __construct(array $data)
    {
        parent::__construct($data);
        if ($this->inventoryTypes) {
            foreach ($this->inventoryTypes as &$type) {
                $type = EVE::universe()->type($type['id']);
            }
        }
    }
}
