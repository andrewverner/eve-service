<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 12.10.2018
 * Time: 22:36
 */

namespace app\components\esi\alliance;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class Alliance extends EVEObject
{
    /**
     * @var int
     */
    public $creatorCorporationId;

    /**
     * @var int
     */
    public $creatorId;

    /**
     * @var \DateTime
     */
    public $dateFounded;

    /**
     * @var int
     */
    public $executorCorporationId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $ticker;

    /**
     * @var int
     */
    public $allianceId;

    public function __construct($allianceId)
    {
        $this->allianceId = $allianceId;

        $cacheKey = "alliance:{$allianceId}";
        $request = EVE::request("/alliances/{alliance_id}/");
        $request->cacheDuration = 3600 * 24;
        $data = $request->send(['alliance_id' => $allianceId], $cacheKey);

        parent::__construct($data);
        $this->dateFounded = new \DateTime($this->dateFounded);
    }

    /**
     * @param $size int 32, 64, 128
     * @return string
     */
    public function image($size)
    {
        return "https://image.eveonline.com/Alliance/{$this->allianceId}_{$size}.png";
    }
}
