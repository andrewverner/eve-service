<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 15:21
 *
 * @var \app\components\esi\corporation\Corporation $corporation
 * @var \app\components\esi\alliance\Alliance $alliance
 * @var \app\components\esi\location\CharacterLocation $location
 * @var \app\components\esi\location\CharacterShip $ship
 */

use app\assets\CharacterDataAsset;
CharacterDataAsset::register($this);
?>
<div class="character-data-panel">
    <table class="eve-table">
        <tr>
            <td>
                <?= \yii\helpers\Html::img($corporation->image(64)); ?>
                <?= $alliance ? \yii\helpers\Html::img($alliance->image(64)) : ''; ?>
            </td>
            <td>
                <?= $corporation->name; ?> [<?= $corporation->ticker; ?>]
                <?php if ($alliance): ?>
                    <br /><?= $alliance->name; ?> [<?= $alliance->ticker ?>]
                <?php endif; ?>
            </td>
            <?php if ($location || $ship): ?>
            <td>
                <?php if ($location): ?>
                    <?php if ($station = $location->station()): ?>
                    <?= \yii\helpers\Html::img($station->image(64)); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($ship): ?>
                    <?= \yii\helpers\Html::img($ship->image(64)); ?>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($location): ?>
                    <?= $location->solarSystem()->name; ?>
                    <?php if ($station = $location->station()): ?>
                    <br /><?= $station->name; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($ship): ?>
                    <br /><?= $ship->shipName; ?> (<?= $ship->type()->name; ?>)
                <?php endif; ?>
            </td>
            <?php endif; ?>
        </tr>
    </table>
</div>
