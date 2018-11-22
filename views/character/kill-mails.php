<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\killmails\KillMail[] $killMails
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
                    <?php if ($killMails): ?>
                        <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Kill mails']); ?>
                        <table class="eve-table kill-mails">
                            <?php foreach ($killMails as $killMail): ?>
                                <tr class="<?= $character->characterId == $killMail->victim->characterId ? 'loss' : 'win'; ?>">
                                    <td><?= \yii\helpers\Html::a(
                                            \yii\helpers\Html::img($killMail->victim->ship()->image(64)),
                                            Yii::$app->urlManager->createUrl("/kill-mail/{$killMail->killmailId}/{$killMail->killmailHash}"),
                                            ['target' => '_blank']
                                        ); ?></td>
                                    <td><?= $killMail->victim->ship()->name; ?></td>
                                    <td><?= $killMail->solarSystem()->name; ?> <?= $killMail->solarSystem()->getFormattedSecurityStatus(true); ?></td>
                                    <td><?= \yii\helpers\Html::img($killMail->victim->character()->image(64)); ?></td>
                                    <td><?= $killMail->victim->character()->name; ?></td>
                                    <td><?= \yii\helpers\Html::img($killMail->victim->corporation()->image(64)); ?></td>
                                    <td><?= $killMail->victim->corporation()->name; ?></td>
                                    <?php if ($killMail->victim->alliance()): ?>
                                        <td><?= \yii\helpers\Html::img($killMail->victim->alliance()->image(64)); ?></td>
                                        <td><?= $killMail->victim->alliance()->name; ?></td>
                                    <?php else: ?>
                                        <td></td>
                                        <td></td>
                                    <?php endif; ?>
                                    <td><?= $killMail->killmailTime->format('Y-m-d H:i:s'); ?></td>
                                    <td><?= \app\components\esi\helpers\EVEFormatter::isk($killMail->lossCost()); ?> ISK</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    <?php else: ?>
                        <div class="note note-info">There are no kill mails so far</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
