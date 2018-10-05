<?php
/**
 * @var \yii\web\View $this
 * @var \DenisKhodakovskiyESI\src\Character $character
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-2">
                <a class="go-back-link" href="<?= Yii::$app->urlManager->createUrl('my') ?>"><i class="fas fa-chevron-circle-left"></i> Go back</a>
                <div class="character-menu-portrait text-center">
                    <?= \yii\helpers\Html::img($character->portrait()->px256x256); ?>
                </div>
                <div class="character-menu-portrait text-center">
                    <?= $character->info()->name; ?>
                </div>
                <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
                <?php \app\widgets\CharacterMenuWidget::end(); ?>
            </div>
            <div class="col-md-10">

            </div>
        </div>
    </div>
</div>
