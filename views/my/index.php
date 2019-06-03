<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\Token[] $tokens
 */

use app\assets\MyAsset;
MyAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php if ($tokens): ?>
                <?php foreach ($tokens as $token): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 col-6 text-center">
                    <div class="character-select-container">
                        <a href="<?= Yii::$app->urlManager->createUrl("/character/{$token->character_id}") ?>">
                            <div class="character-select-portrait">
                                <?= \yii\helpers\Html::img($token->character()->image(256)); ?>
                            </div>
                            <div class="character-select-name">
                                <?= $token->character_name; ?>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="col-lg-8 col-lg-offset-2 col-md-12 col-sm-12 col-xs-12">
                <div class="eve-panel">
                    <div class="eve-panel-body">
                        <h3>Hello.</h3><br />
                        This is your account main page. Here you will find characters list, but first you have to add one.
                        You can do this by clicking "plus" button at the top right corner.<br /><br />
                        Please, note that some of our website's services are not free. But you can try them for free in
                        a trial period that starts right after you add your first character and will expire in 2 weeks
                        after that.<br /><br />
                        We accept only in-game payments. To make a payment you just need to transfer specific amount of
                        ISKs with a specific comment to our corporation account. All information about payments you will
                        find on the invoices page.
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <a href="<?= Yii::$app->urlManager->createUrl('/my/add') ?>" class="eve-btn btn-primary">
                    <i class="fas fa-plus"></i> Add new character
                </a>
            </div>
        </div>
    </div>
</div>
