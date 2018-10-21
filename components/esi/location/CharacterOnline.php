<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.10.18
 * Time: 12:47
 */

namespace app\components\esi\location;

use app\components\esi\components\EVEObject;

class CharacterOnline extends EVEObject
{
    /**
     * @var \DateTime
     */
    public $lastLogin;

    /**
     * @var \DateTime
     */
    public $lastLogout;

    /**
     * @var int
     */
    public $logins;

    /**
     * @var bool
     */
    public $online;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->lastLogin = new \DateTime($this->lastLogin);
        $this->lastLogout = new \DateTime($this->lastLogout);
    }
}
