<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 16.10.18
 * Time: 12:24
 */

namespace app\components\esi\bookmarks;

use app\components\esi\character\Character;
use app\components\esi\components\EVEObject;
use app\components\esi\EVE;
use app\components\esi\universe\SolarSystem;

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

    /**
     * @var Character;
     */
    private $creator;

    /**
     * @var SolarSystem
     */
    private $location;

    public function __construct($data)
    {
        parent::__construct($data);
        $this->created = new \DateTime(($this->created));
        if ($this->item) {
            $this->item = new CharacterBookmarkItem($this->item);
        }
    }

    /**
     * @return Character
     * @throws \yii\web\NotFoundHttpException
     */
    public function creator()
    {
        if (!$this->creator) {
            $this->creator = EVE::character($this->creatorId);
        }

        return $this->creator;
    }

    /**
     * @return SolarSystem
     */
    public function location()
    {
        if (!$this->location) {
            $this->location = EVE::universe()->solarSystem($this->locationId);
        }

        return $this->location;
    }
}
