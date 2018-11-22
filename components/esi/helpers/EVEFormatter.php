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

    public static function securityStatus($ss)
    {
        return number_format(round($ss, 1), 1, '.', ' ');
    }

    public static function standing($standing)
    {
        return number_format(round($standing, 2), 2, '.', ' ');
    }
}
