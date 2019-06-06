<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:10
 */

namespace app\components\esi\components;

use app\models\Scope;
use app\models\Token;

class SecureRequest extends Request
{
    /**
     * @var Token
     */
    private $token;

    const SCOPE_MAP = [
        '/characters/{character_id}/assets/' => Scope::SCOPE_ASSETS_READ,
        '/characters/{character_id}/location/' => Scope::SCOPE_LOCATION_READ,
        '/characters/{character_id}/blueprints/' => Scope::SCOPE_BP_READ,
        '/characters/{character_id}/skillqueue/' => Scope::SCOPE_SKILL_QUEUE_READ,
        '/characters/{character_id}/ship/' => Scope::SCOPE_SHIP_READ,
        '/characters/{character_id}/mail/' => Scope::SCOPE_MAIL_READ,
        '/characters/{character_id}/mail/{mail_id}/' => Scope::SCOPE_MAIL_READ,
        '/characters/{character_id}/online/' => Scope::SCOPE_ONLINE_READ,
        '/ui/autopilot/waypoint/' => Scope::SCOPE_WAY_POINT_WRITE,
        '/characters/{character_id}/agents_research/' => Scope::SCOPE_AGENT_RESEARCH_READ,
        '/characters/{character_id}/bookmarks/' => Scope::SCOPE_BOOKMARKS_READ,
        '/characters/{character_id}/bookmarks/folders/' => Scope::SCOPE_BOOKMARKS_READ,
        '/characters/{character_id}/calendar/' => Scope::SCOPE_CALENDAR_READ,
        '/characters/{character_id}/wallet/' => Scope::SCOPE_WALLET_READ,
        '/characters/{character_id}/wallet/journal/' => Scope::SCOPE_WALLET_READ,
        '/characters/{character_id}/wallet/transactions/' => Scope::SCOPE_WALLET_READ,
        '/characters/{character_id}/killmails/recent/' => Scope::SCOPE_KILL_MAILS_READ,
        '/characters/{character_id}/standings/' => Scope::SCOPE_STANDINGS_READ,
        '/characters/{character_id}/skills/' => Scope::SCOPE_SKILLS_READ,
        '/characters/{character_id}/notifications/' => Scope::SCOPE_NOTIFICATIONS_READ,
        '/characters/{character_id}/industry/jobs/' => Scope::SCOPE_INDUSTRY_JOBS_READ,
        '/universe/structures/{structure_id}/' => Scope::SCOPE_STRUCTURES_READ,
    ];

    public function __construct($uri, Token $token, string $type = null)
    {
        parent::__construct($uri, $type);
        $this->token = $token;
    }

    public function send(array $params = null, string $cacheKey = null, bool $force = null)
    {
        if ($this->token->isExpired()) {
            if (!$this->token->refresh()) {
                $this->error = 'Error updating access token';
                return false;
            }
        }

        if (!$this->token->hasAccess(self::SCOPE_MAP[$this->uri])) {
            $this->error = 'Access for this scope is denied';
            return false;
        }

        $this->query = array_merge($this->query, ['token' => $this->token->access_token]);

        return parent::send($params, $cacheKey, $force);
    }
}
