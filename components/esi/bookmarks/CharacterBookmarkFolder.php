<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 12:29
 */

namespace app\components\esi\bookmarks;

use app\components\esi\components\EVEObject;

class CharacterBookmarkFolder extends EVEObject
{
    /**
     * @var int
     */
    public $folderId;

    /**
     * @var string
     */
    public $name;
}
