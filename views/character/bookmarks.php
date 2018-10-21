<?php
/**
 * @var \app\components\esi\bookmarks\CharacterBookmark[] $bookmarks
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\bookmarks\CharacterBookmarkFolder[] $folders
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Bookmarks";
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12 eve-columns-container">
                    <?php if ($bookmarks): ?>
                        <?php foreach ($bookmarks as $folderId => $bookmarksList): ?>
                            <div class="character-panel">
                                <div class="character-panel-title">
                                    <?= $folderId ? $folders[$folderId]->name : 'Bookmarks' ?>
                                </div>
                                <div class="character-panel-body">
                                    <?php var_dump($bookmarksList) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <div class="note note-info">Character doesn't have any bookmarks</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
