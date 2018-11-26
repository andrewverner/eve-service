<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 14:38
 */

namespace app\components\esi\notifications;

use app\components\esi\components\EVEObject;
use app\components\esi\EVE;

class CorpNewCEOMsg extends EVEObject
{
    /**
     * @var int
     */
    public $corpID;

    /**
     * @var int
     */
    public $newCeoID;

    /**
     * @var int
     */
    public $oldCeoID;

    public function __construct($yaml)
    {
        $data = yaml_parse($yaml);
        parent::__construct($data);
    }

    public function parse()
    {
        $corporation = EVE::corporation($this->corpID);
        $oldCeo = EVE::character($this->oldCeoID);
        $newCeo = EVE::character($this->newCeoID);

        return "<strong>{$oldCeo->name}</strong> has resigned as CEO of <strong>{$corporation->name}</strong>. New CEO is <strong>{$newCeo->name}</strong>";
    }
}
