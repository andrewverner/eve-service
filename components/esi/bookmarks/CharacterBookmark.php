<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 12:24
 */

namespace app\components\esi\bookmarks;

use app\components\esi\components\EVEObject;

class CharacterBookmark extends EVEObject
{
    /**
     * @var int
     */
    public $bookmarkId;

    /**
     * @var array
     */
    public $coordinates;

    /**
     * @var \DateTime
     */
    public $created;

    /**
     * @var int
     */
    public $creatorId;

    /**
     * @var int
     */
    public $folderId;

    /**
     * @var CharacterBookmarkFolder|null
     */
    public $folder;

    /**
     * @var CharacterBookmarkItem
     */
    public $item;

    /**
     * @var string
     */
    public $label;

    /**
     * @var int
     */
    public $locationId;

    /**
     * @var string
     */
    public $notes;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->created = new \DateTime(($this->created));
        if ($this->item) {
            $this->item = new CharacterBookmarkItem($this->item);
        }
    }
}
