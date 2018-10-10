<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 10:19
 */

namespace app\components\esi\character;

use app\components\esi\assets\CharacterAssetItem;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\models\Token;
use app\components\esi\location\CharacterLocation;

class Character extends EVEObject
{
    /**
     * @var int
     */
    public $characterId;

    /**
     * @var Token
     */
    private $token;

    /**
     * @var int
     */
    public $allianceId;

    /**
     * @var int
     */
    public $ancestryId;

    /**
     * @var \DateTime
     */
    public $birthday;

    /**
     * @var int
     */
    public $bloodlineId;

    /**
     * @var int
     */
    public $corporationId;

    /**
     * @var string
     */
    public $description;

    /**
     * @var int
     */
    public $factionId;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $raceId;

    /**
     * @var float
     */
    public $securityStatus;

    /**
     * @var CharacterPortrait
     */
    private $portrait;

    public function __construct($characterId, Token $token = null)
    {
        $this->characterId = $characterId;
        $this->token = $token;

        $request = EVE::request("/characters/{character_id}/");
        $data = $request->send(['character_id' => $this->characterId]);

        parent::__construct($data);
        $this->birthday = new \DateTime($this->birthday);
    }

    /**
     * @param Token $token
     * @return $this
     */
    public function setToken(Token $token) {
        $this->token = $token;
        return $this;
    }

    /**
     * @param int $page
     * @return CharacterAssetItem[]
     */
    public function assets($page = 1)
    {
        $cacheKey = "character:{$this->characterId}:assets:{$page}";

        $request = EVE::secureRequest("/characters/{character_id}/assets/", $this->token);
        $request->query(['page' => $page]);
        $assets = $request->send(['character_id' => $this->characterId], $cacheKey);
        if (!$assets) {
            $assets = [];
        }

        foreach ($assets as &$item) {
            $item = new CharacterAssetItem($item);
        }

        return $assets;
    }

    /**
     * @return CharacterPortrait
     */
    public function portrait()
    {
        if (!$this->portrait) {
            $cacheKey = "character:{$this->characterId}:portrait";

            $request = EVE::request('/characters/{character_id}/portrait/');
            $request->cacheDuration = 3600;
            $this->portrait = new CharacterPortrait($request->send(['character_id' => $this->characterId], $cacheKey));
        }

        return $this->portrait;
    }

    /**
     * @return bool|CharacterLocation
     */
    public function location()
    {
        $request = EVE::secureRequest("/characters/{character_id}/location/", $this->token);
        $location = $request->send(['character_id' => $this->characterId]);
        if (!$location) {
            return false;
        }

        return new CharacterLocation($location);
    }
}
