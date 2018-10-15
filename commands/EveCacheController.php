<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 15.10.18
 * Time: 15:55
 */

namespace app\commands;

use app\components\esi\EVE;
use yii\console\Controller;

class EveCacheController extends Controller
{
    public function actionTypes()
    {
        $page = 1;
        while ($types = EVE::universe()->types($page)) {
            echo "Page {$page}. " . count($types) . ' types were fetched. Processing...' . PHP_EOL;
            foreach ($types as $type) {
                $item = EVE::universe()->type($type);
                echo "#{$item->typeId}}: {$item->name} cached" . PHP_EOL;
            }
            $page++;
        }
    }
}
