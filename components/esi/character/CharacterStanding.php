<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.11.18
 * Time: 16:18
 */

namespace app\components\esi\character;

class CharacterStanding
{
    /**
     * @var Standing[]
     */
    public $agents = [];

    /**
     * @var Standing[]
     */
    public $npcCorps = [];

    /**
     * @var Standing[]
     */
    public $factions = [];

    public function __construct(array $data)
    {
        if (!$data) {
            return;
        }

        foreach ($data as $standing) {
            $standing = new Standing($standing);
            if ($standing->fromType == Standing::FROM_AGENT) {
                $this->agents[] = $standing;
            } elseif ($standing->fromType == Standing::FROM_NPC_CORP) {
                $this->npcCorps[] = $standing;
            } else {
                $this->factions[] = $standing;
            }
        }
    }
}
