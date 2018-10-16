<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 10:19
 */

namespace app\components\esi\character;

use app\components\esi\assets\CharacterAssetItem;
use app\components\esi\bookmarks\CharacterBookmark;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\location\CharacterOnline;
use app\components\esi\location\CharacterShip;
use app\components\esi\mail\MailBody;
use app\components\esi\skills\QueuedSkill;
use app\models\Token;
use app\components\esi\location\CharacterLocation;
use app\components\esi\mail\CharacterMailListItem;

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

        $cacheKey = "character:{$characterId}";
        $request = EVE::request("/characters/{character_id}/");
        $request->cacheDuration = 3600;
        $data = $request->send(['character_id' => $this->characterId], $cacheKey);

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
            $request->cacheDuration = 3600 * 6;
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

    /**
     * @param int $page
     * @return CharacterBlueprint[]
     */
    public function blueprints($page = 1)
    {
        $cacheKey = "character:{$this->characterId}:blueprints:{$page}";

        $request = EVE::secureRequest("/characters/{character_id}/blueprints/", $this->token);
        $request->cacheDuration = 3600;
        $blueprints = $request->send(['character_id' => $this->characterId], $cacheKey);

        if (!$blueprints) {
            return [];
        }

        foreach ($blueprints as &$blueprint) {
            $blueprint = new CharacterBlueprint($blueprint);
        }

        return $blueprints;
    }

    /**
     * @return QueuedSkill[]
     */
    public function skillQueue()
    {
        $cacheKey = "skillqueue:{$this->characterId}";
        $request = EVE::secureRequest("/characters/{character_id}/skillqueue/", $this->token);
        $request->cacheDuration = 120;
        $queue = $request->send(['character_id' => $this->characterId], $cacheKey);

        if (!$queue) {
            return [];
        }

        foreach ($queue as &$skill) {
            $skill = new QueuedSkill($skill);
        }

        usort($queue, function ($first, $second) {
            return $first->queuePosition <=> $second->queuePosition;
        });

        return $queue;
    }

    /**
     * @return CharacterShip|null
     */
    public function ship()
    {
        $request = EVE::secureRequest("/characters/{character_id}/ship/", $this->token);
        $ship = $request->send(['character_id' => $this->characterId]);
        if (!$ship) {
            return null;
        }

        return new CharacterShip($ship);
    }

    /**
     * @param null $lastMailId
     * @return CharacterMailListItem[]
     */
    public function mailList($lastMailId = null)
    {
        $request = EVE::secureRequest("/characters/{character_id}/mail/", $this->token);
        if ($lastMailId) {
            $request->query(['last_mail_id' => $lastMailId]);
        }
        $mails = $request->send(['character_id' => $this->characterId]);


        if (!$mails) {
            return [];
        }

        foreach ($mails as &$mail) {
            $mail = new CharacterMailListItem($mail);
        }

        usort($mails, function ($first, $second) {
            return $first->timestamp <=> $second->timestamp;
        });

        return array_reverse($mails);
    }

    /**
     * @param $mailId
     * @return MailBody|bool
     */
    public function mailBody($mailId)
    {
        $request = EVE::secureRequest('/characters/{character_id}/mail/{mail_id}/', $this->token);
        $mailBody = $request->send([
            'character_id' => $this->characterId,
            'mail_id' => $mailId,
        ]);

        if (!$mailBody) {
            return false;
        }

        return new MailBody($mailBody);
    }

    /**
     * @return CharacterOnline|bool
     */
    public function online()
    {
        $request = EVE::secureRequest("/characters/{character_id}/online/", $this->token);
        $data = $request->send(['character_id' => $this->characterId]);

        return new CharacterOnline($data);
    }

    /**
     * @return CharacterAgentResearch[]
     */
    public function agentsResearch()
    {
        $request = EVE::secureRequest("/characters/{character_id}/agents_research/", $this->token);
        $request->cacheDuration = 1800;
        $researches = $request->send(['character_id' => $this->characterId]);

        if (!$researches) {
            return [];
        }

        foreach ($researches as &$research) {
            $research = new CharacterAgentResearch($research);
        }

        return $researches;
    }

    /**
     * @return CharacterBookmark[]
     */
    public function bookmarks()
    {
        $request = EVE::secureRequest("/characters/{character_id}/bookmarks/", $this->token);
        $request->cacheDuration = 1800;
        $bookmarks = $request->send(['character_id' => $this->characterId]);

        if (!$bookmarks) {
            return [];
        }

        foreach ($bookmarks as &$bookmark) {
            $bookmark = new CharacterBookmark($bookmark);
        }

        return $bookmarks;
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }
}
