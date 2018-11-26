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
use app\components\esi\bookmarks\CharacterBookmarkFolder;
use app\components\esi\calendar\CharacterCalendarEvent;
use app\components\esi\components\EVEObject;
use app\components\esi\components\Request;
use app\components\esi\corporation\Corporation;
use app\components\esi\EVE;
use app\components\esi\killmails\KillMail;
use app\components\esi\location\CharacterOnline;
use app\components\esi\location\CharacterShip;
use app\components\esi\mail\MailBody;
use app\components\esi\skills\CharacterSkills;
use app\components\esi\skills\QueuedSkill;
use app\components\esi\wallet\CharacterWallet;
use app\models\Token;
use app\components\esi\location\CharacterLocation;
use app\components\esi\mail\CharacterMailListItem;
use yii\web\NotFoundHttpException;

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

    /**
     * @var Corporation
     */
    private $corporation;

    public function __construct($characterId, Token $token = null)
    {
        $this->characterId = $characterId;
        $this->token = $token;

        $cacheKey = "character:{$characterId}";
        $request = EVE::request("/characters/{character_id}/");
        $request->cacheDuration = 3600;
        $data = $request->send(['character_id' => $this->characterId], $cacheKey);

        if (!$data) {
            throw new NotFoundHttpException('Character not found');
        }

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
     * @return CharacterBookmarkFolder[]
     */
    public function bookmarksFolders()
    {
        $request = EVE::secureRequest("/characters/{character_id}/bookmarks/folders/", $this->token);
        $request->cacheDuration = 1800;
        $folders = $request->send(['character_id' => $this->characterId]);

        if (!$folders) {
            return [];
        }

        foreach ($folders as &$folder) {
            $folder = new CharacterBookmarkFolder($folder);
        }

        return $folders;
    }

    /**
     * @return CharacterCalendarEvent[]
     */
    public function calendarEvents()
    {
        $request = EVE::secureRequest("/characters/{character_id}/calendar/", $this->token);
        $events = $request->send(['character_id' => $this->characterId]);

        if (!$events) {
            return [];
        }

        foreach ($events as &$event) {
            $event = new CharacterCalendarEvent($event);
        }

        return $events;
    }

    public function addWayPoint($destinationId, $addToBeginning = false, $clearOtherWaypoints = false)
    {
        $request = EVE::secureRequest("/ui/autopilot/waypoint/", $this->token, Request::TYPE_POST);
        $request->query([
            'add_to_beginning' => $addToBeginning ? 'true' : 'false',
            'clear_other_waypoints' => $clearOtherWaypoints ? 'true' : 'false',
            'destination_id' => $destinationId,
        ]);
        $request->send();
    }

    /**
     * @return CharacterWallet
     */
    public function wallet()
    {
        return new CharacterWallet($this->token);
    }

    /**
     * @return KillMail[]
     * @throws NotFoundHttpException
     */
    public function killMails()
    {
        $cacheKey = "character:killmails:{$this->characterId}";
        $request = EVE::secureRequest('/characters/{character_id}/killmails/recent/', $this->token);
        $request->cacheDuration = 300;
        $killMails = $request->send(['character_id' => $this->characterId], $cacheKey);
        if (!$killMails) {
            return false;
        }

        foreach ($killMails as &$killMail) {
            $killMail = new KillMail($killMail);
        }

        return $killMails;
    }

    /**
     * @return CharacterStanding
     */
    public function standing()
    {
        $cacheKey = "character:standings:{$this->characterId}";
        $request = EVE::secureRequest('/characters/{character_id}/standings/', $this->token);
        $request->cacheDuration = 3600;
        $data = $request->send(['character_id' => $this->characterId], $cacheKey);

        return new CharacterStanding($data);
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return Corporation
     */
    public function corporation()
    {
        if (!$this->corporation) {
            $this->corporation = EVE::corporation($this->corporationId);
        }

        return $this->corporation;
    }

    public function image($size)
    {
        return "https://image.eveonline.com/Character/{$this->characterId}_{$size}.jpg";
    }

    /**
     * @return CharacterSkills|null
     */
    public function skills()
    {
        $cacheKey = "character:{$this->characterId}:skills";
        $request = EVE::secureRequest('/characters/{character_id}/skills/', $this->token);
        $request->cacheDuration = 1800;
        $skills = $request->send(['character_id' => $this->characterId], $cacheKey);

        if (!$skills) {
            return null;
        }

        return new CharacterSkills($skills);
    }

    public function notifications()
    {
        $cacheKey = "character:{$this->characterId}:notifications";
        $request = EVE::secureRequest('/characters/{character_id}/notifications/', $this->token);
        $request->cacheDuration = 600;
        $notifications = $request->send(['character_id' => $this->characterId], $cacheKey);

        if (!$notifications) {
            return null;
        }

        foreach ($notifications as &$notification) {
            $notification = new Notification($notification);
        }

        return $notifications;
    }
}
