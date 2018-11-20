<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 13:10
 */

namespace app\components\pi\schematics;

use app\components\esi\EVE;
use app\components\esi\universe\Type;

class Schematic
{
    protected const INPUT = [];
    protected const OUTPUT = [];

    public static function input()
    {
        return static::INPUT;
    }

    /**
     * @return InputSchematicType[]
     */
    public static function inputTypes()
    {
        $types = [];
        foreach (static::INPUT as $id => $quantity) {
            $types[] = new InputSchematicType($id, $quantity);
        }

        return $types;
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        $output = array_keys(static::OUTPUT);
        return reset($output);
    }

    /**
     * @return Type
     */
    public static function type()
    {
        return EVE::universe()->type(array_keys(static::OUTPUT)[0]);
    }

    /**
     * @return int
     */
    public static function quantity()
    {
        $output = static::OUTPUT;
        return reset($output);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval(1);
    }
}