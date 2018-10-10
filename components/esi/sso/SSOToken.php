<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:54
 */

namespace app\components\esi\sso;

use app\components\esi\components\EVEObject;

class SSOToken extends EVEObject
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
