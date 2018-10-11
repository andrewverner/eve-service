<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\assets\CharacterAssetsList $assets
 * @var \app\components\esi\location\CharacterLocation $location
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Assets";
?>
<div class="site-index">
    <div class="body-content">
        <div class="character-menu-container">
            <div class="character-photo-container">
                <a class="go-back-link eve-btn eve-btn-primary" href="<?= Yii::$app->urlManager->createUrl('my') ?>"><i class="fas fa-chevron-circle-left"></i> Go back</a>
                <div class="character-menu-portrait text-center">
                    <?= \yii\helpers\Html::img($character->portrait()->px256x256); ?>
                </div>
                <div class="character-menu-name text-center">
                    <?= $character->name; ?>
                </div>
            </div>
            <div class="character-menu">
                <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
                <?php \app\widgets\CharacterMenuWidget::end(); ?>
            </div>
        </div>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?php foreach ($assets->stations as $id => $assetsList): ?>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
