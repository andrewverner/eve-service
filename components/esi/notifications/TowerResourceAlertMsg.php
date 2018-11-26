<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 15:44
 */

namespace app\components\esi\notifications;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class TowerResourceAlertMsg extends EVEObject
{
    /**
     * @var int
     */
    public $allianceID;

    /**
     * @var int
     */
    public $corpID;

    /**
     * @var int
     */
    public $moonID;

    /**
     * @var int
     */
    public $solarSystemID;

    /**
     * @var int
     */
    public $typeID;

    /**
     * @var TowerMissingResource[]
     */
    public $wants;

    public function __construct($yaml)
    {
        $data = yaml_parse($yaml);
        parent::__construct($data);

        foreach ($this->wants as &$missingResource) {
            $missingResource = new TowerMissingResource($missingResource);
        }
    }

    public function parse()
    {
        $owner = [];
        if ($this->allianceID) {
            $alliance = EVE::alliance($this->allianceID);
            $owner[] = "Alliance: <strong>{$alliance->name}</strong>";
        }
        $corporation = EVE::corporation($this->corpID);
        $owner[] = "Corporation: <strong>{$corporation->name}</strong>";
        $owner = implode(', ', $owner);

        $solarSystem = EVE::universe()->solarSystem($this->solarSystemID);
        $ss = $solarSystem->getFormattedSecurityStatus(true);

        $fuel = [];
        foreach ($this->wants as $missingResource) {
            $fuel[] = "{$missingResource->type()->name} ($missingResource->quantity)";
        }

        $str = "Control tower has low fuel.<br />Owner: {$owner}.<br />Location: {$solarSystem->name} ($ss).<br />Fuel: " . implode(', ', $fuel);

        return $str;
    }
}
