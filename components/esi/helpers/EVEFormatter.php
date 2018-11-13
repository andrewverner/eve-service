<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 13.11.18
 * Time: 18:06
 */

namespace app\components\esi\helpers;

class EVEFormatter
{
    public static function isk($amount)
    {
        return number_format($amount, 2, '.', ' ');
    }
}
