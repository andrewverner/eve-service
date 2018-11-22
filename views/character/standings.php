<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\CharacterStanding $standings
 * @var \app\components\esi\character\Character $character
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Standings";
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
                    <?php if ($standings->agents || $standings->npcCorps || $standings->factions): ?>
                        <?php if ($standings->agents): ?>
                            <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Agents']); ?>
                                <table class="eve-table colored">
                                    <?php foreach ($standings->agents as $agent): ?>
                                        <?php if (!$agent->from()) { continue; } ?>
                                        <tr>
                                            <td><?= \yii\helpers\Html::img($agent->from()->image(64)); ?></td>
                                            <td><?= $agent->from()->name; ?><br /><?= $agent->from()->corporation()->name; ?></td>
                                            <td><?= $agent->standing; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php \app\widgets\CharacterPanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($standings->npcCorps): ?>
                            <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'NPC Corporations']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($standings->npcCorps as $npcCorp): ?>
                                    <tr>
                                        <td><?= \yii\helpers\Html::img($npcCorp->from()->image(64)); ?></td>
                                        <td><?= $npcCorp->from()->name; ?></td>
                                        <td><?= $npcCorp->standing; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\CharacterPanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($standings->factions): ?>
                            <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Factions']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($standings->factions as $faction): ?>
                                    <tr>
                                        <td><?= \yii\helpers\Html::img($faction->from()->image(64)); ?></td>
                                        <td><?= $faction->from()->name; ?></td>
                                        <td><?= $faction->standing; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\CharacterPanelWidget::end(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                    <div class="note note-info">
                        Standings list is empty
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
