<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\character\CharacterBlueprint[] $blueprints
 */

use app\assets\BlueprintsAsset;
BlueprintsAsset::register($this);

$this->title = "{$character->name}: Blueprints";
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
                    <div class="note note-info">
                        <i class="fas fa-clock"></i> Cached for 1 hour <i class="fas fa-question-circle cache-info" data-toggle="modal" data-target="#cache-modal"></i>
                    </div>
                    <div class="note note-info">
                        <i class="fas fa-info-circle"></i> "C" in right bottom corner of a blueprint means that it's a blueprint copy. "O" - original. Positive number - a stack of blueprint originals fresh from the market
                    </div>
                    <?php if (!empty($blueprints)): ?>
                    <div class="row">
                        <div class="col-12">
                        <?php foreach ($blueprints as $blueprint): ?>
                            <div class="bp-container" data-material="<?= $blueprint->materialEfficiency; ?>"
                                data-runs="<?= $blueprint->runs; ?>" data-time="<?= $blueprint->timeEfficiency; ?>"
                                data-type-id="<?= $blueprint->typeId; ?>">
                                <div class="bp-img" style="background-image: url(http://image.eveonline.com/Type/<?= $blueprint->typeId ?>_64.png)">
                                    <span class="bp-count"><?= $blueprint->quantity == -2 ? 'C' : ($blueprint->quantity == -1 ? 'O' : $blueprint->quantity); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="note note-info">
                            <?= $character->name ?> doesn't have any blueprints
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bp-modal">
    <div class="bp-data">
        <table class="eve-table">
            <tr>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2</td>
            </tr>
            <tr>
                <td>3</td>
                <td>3</td>
            </tr>
            <tr>
                <td>4</td>
                <td>4</td>
            </tr>
        </table>
    </div>
</div>
