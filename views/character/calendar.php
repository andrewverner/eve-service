<?php
/**
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\calendar\CharacterCalendarEvent $events
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Calendar events";
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?php if ($events): ?>
                        <div class="character-panel">
                            <div class="character-panel-title">Calendar events</div>
                            <div class="character-panel-body">
                                <?php var_dump($events) ?>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="note note-info"><?= $character->name ?> doesn't have any upcoming events</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
