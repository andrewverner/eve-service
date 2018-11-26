<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 26.11.18
 * Time: 17:02
 */

namespace app\components\esi\notifications;

use app\components\esi\alliance\Alliance;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\UniverseName;

class AllWarDeclaredMsg extends EVEObject
{
    /**
     * @var int
     */
    public $againstID;

    /**
     * @var int
     */
    public $cost;

    /**
     * @var int
     */
    public $declaredByID;

    /**
     * @var int
     */
    public $delayHours;

    /**
     * @var int
     */
    public $hostileState;

    public function __construct($yaml)
    {
        $data = yaml_parse($yaml);
        parent::__construct($data);
    }

    public function parse()
    {
        $initiators = EVE::universe()->names([$this->declaredByID]);
        $victims = EVE::universe()->names([$this->againstID]);

        if (!$initiators || !$victims) {
            return 'Something went wrong while parsing notification data';
        }

        $initiator = $initiators[0];
        $victim = $victims[0];

        $initiatorType = $initiator->category == UniverseName::CATEGORY_ALLIANCE ? 'Alliance' : 'Corporation';
        $victimType = $victim->category == UniverseName::CATEGORY_ALLIANCE ? 'Alliance' : 'Corporation';

        return "{$initiatorType} <strong>{$initiator->model()->name}</strong> has declared a war against {$victimType} <strong>{$victim->model()->name}</strong>. The war starts in {$this->delayHours} hours";
    }
}
