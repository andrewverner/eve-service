<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\character\Notification[] $notifications
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Notifications";
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
            <?php if ($notifications): ?>
                <div class="row">
                    <div class="col-12">
                        <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Notifications']); ?>
                        <table class="eve-table colored">
                            <?php foreach ($notifications as $notification): ?>
                            <tr>
                                <td><?= $notification->timestamp->format('Y-m-d H:i:s'); ?></td>
                                <td>
                                    <?= $notification->getText(); ?>
                                </td>
                                <td><?= $notification->type; ?></td>
                                <td><?= $notification->senderType; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="note note-info">
                    Notifications list is empty
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
