<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 11:58
 */

namespace app\components\pi;

class Planet
{
    /**
     * @return array
     */
    public function getMaterials() {
        return $this->materials;
    }

    public function getClass()
    {
        return (new \ReflectionClass(get_called_class()))->getShortName();
    }
}
