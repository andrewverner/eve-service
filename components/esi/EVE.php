<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 13:06
 */

namespace app\components\esi;

use app\components\esi\components\EVERequest;
use app\components\esi\components\EVESSO;
use yii\base\Component;

class EVE extends Component
{
    public $clientId;
    public $secretKey;
    public $callback;

    /**
     * @param string $uri
     * @param string|null $type
     * @return EVERequest
     */
    public function request(string $uri, string $type = null)
    {
        return new EVERequest($uri, $type);
    }

    public function sso()
    {
        return new EVESSO($this->clientId, $this->secretKey, $this->callback);
    }
}
