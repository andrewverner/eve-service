<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 14:03
 */

namespace app\components\esi\components;

class SSOToken extends BaseObject
{
    /**
     * @var string
     */
    public $accessToken;

    /**
     * @var string
     */
    public $tokenType;

    /**
     * @var int
     */
    public $expiresIn;

    /**
     * @var string
     */
    public $refreshToken;
}
