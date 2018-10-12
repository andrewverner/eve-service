<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\mail\CharacterMailListItem[] $list
 */

use app\assets\MailListAsset;
MailListAsset::register($this);

$this->title = "{$character->name}: Mail";
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?php if (!empty($list)): ?>
                    <div class="character-panel">
                        <div class="character-panel-title">
                            <i class="fas fa-envelope"></i> Mail
                        </div>
                        <div class="character-panel-body">
                            <div class="mails-list">
                                <?= $this->render('_mail-list', [
                                    'list' => $list,
                                    'characterId' => $character->characterId,
                                ]); ?>
                            </div>
                            <?php if (count($list) >= 50): ?>
                                <div class="text-center">
                                    <span class="eve-btn eve-btn-primary load-more" data-character-id="<?= $character->characterId ?>">Load more...</span>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="note note-info">Mails list is empty or Tranquility server isn't available at the moment</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
