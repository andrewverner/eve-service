<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 11.10.18
 * Time: 8:26
 */

namespace app\components\esi\universe;

class Route
{
    const FLAG_SECURE   = 'secure';
    const FLAG_INSECURE = 'insecure';
    const FLAG_SHORTEST = 'shortest';

    /**
     * @var int[]
     */
    public $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
}
