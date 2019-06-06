<?php

use yii\web\View;
use yii\helpers\Html;
use app\components\esi\character\Character;
use app\modules\character\widgets\MenuItem;

/**
 * @var View $this
 * @var MenuItem[] $menu
 * @var Character $character
 */
?>

<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">CHARACTER MENU</li>
            <?php foreach ($menu as $menuItem): ?>
                <li>
                    <a href="<?= $menuItem->url; ?>">
                        <?= $menuItem->getIcon(); ?>
                        <?= Html::tag('span', Yii::t('app', $menuItem->label)); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</aside>
