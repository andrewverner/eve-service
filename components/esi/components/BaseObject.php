<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 09.10.18
 * Time: 14:04
 */

namespace app\components\esi\components;

class BaseObject
{
    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
            $this->{$key} = $value;
        }
    }
}
