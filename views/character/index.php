<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\skills\QueuedSkill[] $skillQueue
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = $character->name;
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
                <?php if ($skillQueue): ?>
                    <div class="col-12">
                        <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Skill queue']); ?>
                        <?= \app\widgets\SkillQueueWidget::widget(['queue' => $skillQueue]); ?>
                        <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
