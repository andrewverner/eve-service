<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 15:16
 */

namespace app\widgets;

use app\components\esi\character\Character;
use app\components\esi\EVE;
use yii\base\Widget;

class CharacterDataWidget extends Widget
{
    /**
     * @var Character
     */
    public $character;

    public function run()
    {
        $this->character->allianceId = 1900696668;

        return $this->render('character-data', [
            'character' => $this->character,
            'corporation' => EVE::corporation($this->character->corporationId),
            'alliance' => $this->character->allianceId
                ? EVE::alliance($this->character->allianceId)
                : null,
            'location' => $this->character->location(),
            'ship' => $this->character->ship(),
        ]);
    }
}
