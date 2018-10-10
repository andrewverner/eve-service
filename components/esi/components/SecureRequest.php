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
    ];

    public function __construct($uri, Token $token, string $type = null)
    {
        parent::__construct($uri, $type);
        $this->token = $token;
    }

    public function send(array $params = null, string $cacheKey = null, bool $force = false)
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
