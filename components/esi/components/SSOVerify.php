<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 14:47
 */

namespace app\components\esi\components;

class SSOVerify extends BaseObject
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
