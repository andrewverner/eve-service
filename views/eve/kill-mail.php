<?php
/**
 * @var \app\components\esi\killmails\KillMail $killMail
 */

use app\assets\KillMailAsset;
KillMailAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <?php \app\widgets\EvePanelWidget::begin(['title' => 'Victim']); ?>
                <div class="row">
                    <div class="col-6">
                        <?= \yii\helpers\Html::img($killMail->victim->ship()->render(256)); ?>
                    </div>
                    <div class="col-6">
                        <?php if ($killMail->fitting()->highSlots): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->highSlots as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($killMail->fitting()->medSlots): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->medSlots as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($killMail->fitting()->lowSlots): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->lowSlots as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($killMail->fitting()->rigSlots): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->rigSlots as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($killMail->fitting()->subsystemSlots): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->subsystemSlots as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($killMail->fitting()->droneBay): ?>
                            <div>
                                <?php foreach ($killMail->fitting()->droneBay as $item): ?>
                                    <?= \yii\helpers\Html::img($item->type()->image(32), ['title' => $item->type()->name]); ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php \app\widgets\EvePanelWidget::end(); ?>
                <?php if ($killMail->victim->items): ?>
                    <div class="row">
                        <div class="col-12">
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Dropped/destroyed items']); ?>
                            <table class="eve-table">
                                <?php foreach ($killMail->victim->items as $item): ?>
                                    <?php $quantity = ($item->quantityDropped + $item->quantityDestroyed); ?>
                                    <tr>
                                        <td><?= \app\components\Html::img($item->type()->image(32)); ?></td>
                                        <td><?= $item->type()->name; ?></td>
                                        <td><?= $quantity; ?></td>
                                        <td><?= \app\components\esi\helpers\EVEFormatter::isk($item->type()->price() * $quantity); ?> ISK</td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td class="text-right" colspan="4">Total loss cost: <?= \app\components\esi\helpers\EVEFormatter::isk($killMail->totalCost()); ?> ISK</td>
                                </tr>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($killMail->attackers): ?>
                    <div class="row">
                        <div class="col-12">
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Attackers']); ?>
                            <table class="eve-table" id="debug">
                                <?php $characters = array_filter($killMail->attackers, function ($attacker) { return $attacker->characterId; }); ?>
                                <?php $npcs = array_filter($killMail->attackers, function ($attacker) { return !$attacker->characterId; }); ?>
                                <?php foreach ($characters as $attacker): ?>
                                    <tr>
                                        <td>
                                            <?= \app\components\Html::img($attacker->character()->portrait()->px64x64); ?>
                                            <?= \app\components\Html::img($attacker->corporation()->image(64)); ?>
                                            <?php if ($attacker->alliance()): ?>
                                                <?= \app\components\Html::img($attacker->alliance()->image(64)); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $attacker->character()->name; ?><br />
                                            <?= $attacker->corporation()->name; ?> [<?= $attacker->corporation()->ticker; ?>]
                                            <?php if ($attacker->alliance()): ?>
                                                <br /><?= $attacker->alliance()->name; ?> [<?= $attacker->alliance()->ticker; ?>]
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($attacker->ship()): ?>
                                                <?= \app\components\Html::img($attacker->ship()->render(64)); ?>
                                            <?php endif; ?>
                                            <?php if ($attacker->weapon()): ?>
                                                <?= \app\components\Html::img($attacker->weapon()->image(64)); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $attacker->damageDone ?>
                                            <?php if ($attacker->finalBlow): ?>(Final blow)<?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php foreach ($npcs as $attacker): ?>
                                    <tr>
                                        <td colspan="2">NPC attacker</td>
                                        <td>
                                            <?php if ($attacker->ship()): ?>
                                                <?= \app\components\Html::img($attacker->ship()->render(64)); ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= $attacker->damageDone ?>
                                            <?php if ($attacker->finalBlow): ?>(Final blow)<?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
