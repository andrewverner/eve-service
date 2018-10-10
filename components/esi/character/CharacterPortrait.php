<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 10.10.18
 * Time: 13:03
 */

namespace app\components\esi\character;

use app\components\esi\components\EVEObject;

class CharacterPortrait extends EVEObject
{
    /**
     * Path to character portrait 64x64 px
     * @var string
     */
    public $px64x64;

    /**
     * Path to character portrait 128x128 px
     * @var string
     */
    public $px128x128;

    /**
     * Path to character portrait 256x256 px
     * @var string
     */
    public $px256x256;

    /**
     * Path to character portrait 512x512 px
     * @var string
     */
    public $px512x512;
}
