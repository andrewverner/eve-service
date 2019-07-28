<?php

namespace app\components\esi\planetary;

use app\components\esi\components\EVEObject;

class PlanetColony extends EVEObject
{
    const SVG_MULTIPLIER = 5000;

    /**
     * @var PlanetColonyLink[]
     */
    public $links;

    /**
     * @var PlanetColonyPin[]
     */
    public $pins;

    /**
     * @var PlanetColonyRoute[]
     */
    public $routes;

    public function __construct(array $data)
    {
        parent::__construct($data);

        foreach ($this->links as &$link) {
            $link = new PlanetColonyLink($link);
        }
        foreach ($this->pins as &$pin) {
            $pin = new PlanetColonyPin($pin);
        }
        foreach ($this->routes as &$route) {
            $route = new PlanetColonyRoute($route);
        }
    }
}
