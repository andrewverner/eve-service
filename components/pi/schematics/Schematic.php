<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 19.11.18
 * Time: 13:10
 */

namespace app\components\pi\schematics;

use app\components\esi\EVE;

class Schematic
{
    protected const INPUT = [];
    protected const OUTPUT = [];

    public static function input()
    {
        return static::INPUT;
    }

    public static function typeId()
    {
        $output = array_keys(static::OUTPUT);
        return reset($output);
    }

    public static function type()
    {
        return EVE::universe()->type(array_keys(static::OUTPUT)[0]);
    }

    public static function quantity()
    {
        $output = static::OUTPUT;
        return reset($output);
    }
}