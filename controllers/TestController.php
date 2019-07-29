<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 18:01
 */

namespace app\controllers;

use app\components\esi\EVE;
use app\components\esi\SearchFactory;
use app\components\esi\universe\Type;
use app\models\Service;
use app\models\Token;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $schematic = EVE::universe()->planetarySchematic(124);
        $typesIds = EVE::universe()->search($schematic->schematicName, [SearchFactory::CATEGORY_INVENTORY_TYPE], true)
            ->inventoryType;

        $types = [];
        foreach ($typesIds as $typeId) {
            $types[] = EVE::universe()->type($typeId);
        }

        $types = array_filter($types, function (Type $type) use ($schematic) {
            return $type->name === $schematic->schematicName;
        });


    }
}
