<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 29.07.19
 * Time: 10:39
 */

namespace app\components;

class SVGHelper
{
    public static function arc($x, $y, $radius, $from, $to, $params = null)
    {
        $d = sprintf(
            'M%f %f A%d %d, 0, 0, 1, %f %f',
            $x + $radius * cos(deg2rad($from)),
            $y + $radius * sin(deg2rad($from)),
            $radius,
            $radius,
            $x + $radius * cos(deg2rad($to)),
            $y + $radius * sin(deg2rad($to))
        );

        if ($params) {
            foreach ($params as $key => &$value) {
                $value = sprintf('%s="%s"', $key, $value);
            }
        }

        return $params
            ? sprintf('<path d="%s" %s></path>', $d, implode(' ', $params))
            : sprintf('<path d="%s"></path>', $d);
    }
}
