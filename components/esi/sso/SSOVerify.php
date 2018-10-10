<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 9:56
 */

namespace app\components\esi\sso;

use app\components\esi\components\EVEObject;

class SSOVerify extends EVEObject
{
    /**
     * @var int
     */
    public $characterID;

    /**
     * @var string
     */
    public $characterName;

    /**
     * @var \DateTime
     */
    public $expiresOn;

    /**
     * @var array
     */
    public $scopes;

    /**
     * @var string
     */
    public $tokenType;

    /**
     * @var string
     */
    public $characterOwnerHash;

    /**
     * @var string
     */
    public $intellectualProperty;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->expiresOn = new \DateTime($this->expiresOn);
        $this->scopes = explode(' ', $this->scopes);
    }
}
