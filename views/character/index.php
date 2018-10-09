<?php
/**
 * @var \yii\web\View $this
 * @var \DenisKhodakovskiyESI\src\Character $character
 * @var \app\models\Token $token
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="character-menu-container">
            <a class="go-back-link eve-btn eve-btn-primary" href="<?= Yii::$app->urlManager->createUrl('my') ?>"><i class="fas fa-chevron-circle-left"></i> Go back</a>
            <div class="character-menu-portrait text-center">
                <?= \yii\helpers\Html::img($character->portrait()->px256x256); ?>
            </div>
            <div class="character-menu-name text-center">
                <?= $character->info()->name; ?>
            </div>
            <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
            <?php \app\widgets\CharacterMenuWidget::end(); ?>
        </div>
        <div class="character-content-container">
            <div class="row">
                <?php if ($token->can(\app\models\Scope::SCOPE_SKILL_QUEUE_READ)): ?>
                <pre>
                    <?php \yii\helpers\VarDumper::dump($character->assets()) ?>
                </pre>
                <?php endif; ?>
                <div class="col-12">
                </div>
            </div>
        </div>
    </div>
</div>
