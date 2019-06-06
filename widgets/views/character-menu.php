<?php
/**
 * @var \app\components\esi\character\Character $character
 * @var array $menu
 */
?>
<div class="character-menu-container">
    <div class="character-photo-container">
        <a class="go-back-link eve-btn eve-btn-primary" href="<?= Yii::$app->urlManager->createUrl('/my'); ?>"><i class="fas fa-chevron-circle-left"></i> Go back</a>
        <div class="character-menu-portrait text-center">
            <a href="<?= Yii::$app->urlManager->createUrl("/character/{$character->characterId}"); ?>">
                <?= \yii\helpers\Html::img($character->image(256)); ?>
            </a>
        </div>
        <div class="character-menu-name text-center">
            <?= $character->name; ?>
        </div>
    </div>
    <div class="character-menu">
        <ul class="character-menu">
            <?php foreach ($menu as $title => $link): ?>
                <li><?= \yii\helpers\Html::a($title, $link, [
                    'class' => trim($link , '/') == Yii::$app->request->getPathInfo() ? 'active' : '',
                    'data-preload-url' => $link . '?preload=1',
                ]); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
