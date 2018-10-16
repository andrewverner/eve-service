<?php
/**
 * @var \app\components\esi\character\CharacterAgentResearch[] $agents
 * @var \app\components\esi\character\Character $character
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Agents research";
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?php if ($agents): ?>
                    <div class="character-panel">
                        <div class="character-panel-title">Agents research</div>
                        <div class="character-panel-body">
                            <?php var_dump($agents); ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="note note-info">Character doesn't have any researches</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
