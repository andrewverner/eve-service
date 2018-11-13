<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:00
 */

namespace app\components\esi;

use app\components\esi\alliance\Alliance;
use app\components\esi\character\Character;
use app\components\esi\components\Request;
use app\components\esi\components\SecureRequest;
use app\components\esi\corporation\Corporation;
use app\components\esi\market\Market;
use app\components\esi\sso\SSO;
use app\components\esi\universe\Universe;
use app\models\Token;

class EVE
{
    /**
     * @param $uri
     * @param array|null $params
     * @param null $type
     * @return Request
     */
    public static function request($uri, array $params = null, $type = null)
    {
        return new Request($uri, $type);
    }

    /**
     * @param $uri
     * @param Token $token
     * @param string $type
     * @return SecureRequest
     */
    public static function secureRequest($uri, Token $token, $type = null)
    {
        return new SecureRequest($uri, $token, $type);
    }

    /**
     * @return SSO
     */
    public static function sso()
    {
        return new SSO(
            \Yii::$app->params['esi']['clientId'],
            \Yii::$app->params['esi']['secretKey'],
            \Yii::$app->params['esi']['callback']
        );
    }

    /**
     * @param int $characterId
     * @param Token|null $token
     * @return Character
     */
    public static function character($characterId, Token $token = null)
    {
        return new Character($characterId, $token);
    }

    /**
     * @return Universe
     */
    public static function universe()
    {
        return new Universe();
    }

    /**
     * @param int $corporationId
     * @param Token|null $token
     * @return Corporation
     */
    public static function corporation($corporationId, Token $token = null)
    {
        return new Corporation($corporationId, $token);
    }

    /**
     * @param int $allianceId
     * @return Alliance
     */
    public static function alliance($allianceId)
    {
        return new Alliance($allianceId);
    }

    /**
     * @return Market
     */
    public static function market()
    {
        return new Market();
    }
}
