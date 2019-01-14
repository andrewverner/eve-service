<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 12.10.2018
 * Time: 22:21
 */

namespace app\components\esi\corporation;

use \app\components\esi\components\EVEObject;

class Corporation extends EVEObject
{
    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $ceoId;

    /**
     * @var int
     */
    public $creatorId;

    /**
     * @var \DateTime
     */
    public $dateFounded;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var int
     */
    public $homeStationId;

    /**
     * @var int
     */
    public $memberCount;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $shares;

    /**
     * @var float
     */
    public $taxRate;

    /**
     * @var string
     */
    public $ticker;

    /**
     * @var string
     */
    public $url;

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var \app\models\Token
     */
    private $token;

    public function __construct($corporationId, \app\models\Token $token = null)
    {
        $this->corporationId = $corporationId;

        $cacheKey = "corporation:{$corporationId}";
        $request = \app\components\esi\EVE::request("/corporations/{corporation_id}/");
        $request->cacheDuration = 3600 * 24;
        $data = $request->send(['corporation_id' => $corporationId], $cacheKey);

        parent::__construct($data);
        $this->dateFounded = new \DateTime($this->dateFounded);
    }

    /**
     * @param int $size 32, 64, 128, 256
     * @return string
     */
    public function image($size)
    {
        return "https://image.eveonline.com/Corporation/{$this->corporationId}_{$size}.png";
    }
}
