<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\wallet\CharacterWallet $wallet
 * @var \app\components\esi\character\Character $character
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Wallet";
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
                <div class="col-12">
                    <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Balance']); ?>
                    Balance: <?= number_format($wallet->balance(), 2, '.', ' '); ?> ISK
                    <?php \app\widgets\CharacterPanelWidget::end(); ?>

                    <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Journal']); ?>
                    <?php if ($wallet->journal()): ?>
                        <table class="eve-table">
                            <?php foreach ($wallet->journal() as $record): ?>
                            <tr>
                                <td><?= $record->date->format('Y-m-d H:i:s'); ?></td>
                                <td>
                                    <span style="color:<?= $record->amount > 0 ? '#44ff44' : '#ff0000'; ?>">
                                        <?= number_format($record->amount, 2, '.', ' '); ?>
                                    </span>
                                </td>
                                <td><?= number_format($record->balance, 2, '.', ' '); ?></td>
                                <td><?= $record->description; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <div class="note note-info">Wallet journal is empty</div>
                    <?php endif; ?>
                    <?php \app\widgets\CharacterPanelWidget::end(); ?>

                    <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Transactions']); ?>
                    <?php if ($wallet->transactions()): ?>
                        <table class="eve-table">
                            <?php foreach ($wallet->transactions() as $transaction): ?>
                                <tr>
                                    <td><?= \yii\helpers\Html::img("http://image.eveonline.com/Type/{$transaction->type()->typeId}_32.png"); ?></td>
                                    <td><?= $transaction->quantity; ?></td>
                                    <td>
                                        <span style="color:<?= !$transaction->isBuy ? '#44ff44' : '#ff0000'; ?>">
                                            <?= number_format($transaction->quantity * $transaction->unitPrice, 2, '.', ' '); ?>
                                        </span>
                                    </td>
                                    <td><?= $transaction->type()->name; ?></td>
                                    <td><?= $transaction->location()->name; ?></td>
                                    <td><?= $transaction->date->format('Y-m-d H:i:s'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <div class="note note-info">Transactions list is empty</div>
                    <?php endif; ?>
                    <?php \app\widgets\CharacterPanelWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
