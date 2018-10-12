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
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
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
