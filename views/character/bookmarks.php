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
        <?= \app\widgets\CharacterMenuWidget::widget(['characterId' => $character->characterId]); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?= \app\widgets\CharacterDataWidget::widget(['character' => $character]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12 eve-columns-container">
                    <?php if ($bookmarks): ?>
                        <?php foreach ($bookmarks as $folderId => $bookmarksList): ?>
                            <?php \app\widgets\CharacterPanelWidget::begin(['title' => $folderId ? $folders[$folderId]->name : 'Bookmarks']); ?>
                            <?php var_dump($bookmarksList); ?>
                            <?php \app\widgets\CharacterPanelWidget::end(); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <div class="note note-info">Character doesn't have any bookmarks</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
