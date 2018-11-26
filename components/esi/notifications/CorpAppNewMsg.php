<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 16:03
 */

namespace app\components\esi\notifications;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class CorpAppNewMsg extends EVEObject
{
    /**
     * @var string
     */
    public $applicationText;

    /**
     * @var int
     */
    public $charID;

    /**
     * @var int
     */
    public $corpID;

    public function __construct($yaml)
    {
        $data = yaml_parse($yaml);
        parent::__construct($data);
    }

    public function parse()
    {
        $character = EVE::character($this->charID);
        $corporation = EVE::corporation($this->corpID);

        $str = "New join application. <strong>{$character->name}</strong> wants to join <strong>{$corporation->name}</strong>";
        if ($this->applicationText) {
            $str .= "<br />{$this->applicationText}";
        }

        return $str;
    }
}
