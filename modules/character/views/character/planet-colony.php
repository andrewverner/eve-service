<?php
use yii\web\View;
use app\components\esi\planetary\PlanetColony;
use app\modules\character\widgets\PlanetColonyWidget;
use app\widgets\BoxWidget;
use app\components\esi\universe\Planet;
use yii\helpers\Html;

use app\assets\PlanetColonyAsset;
PlanetColonyAsset::register($this);

/**
 * @var View $this
 * @var PlanetColony $colony
 * @var Planet $planet
 */
?>
<div class="character-planetary-planet-colony">
    <?php BoxWidget::begin(['title' => $planet->name]); ?>
    <div style="background-image: url(/images/planetary/<?= strtolower(str_replace(['Planet (', ')'], '', $planet->type()->name)) ?>.png); background-position: 50% 50%">
        <?= PlanetColonyWidget::widget(['colony' => $colony]); ?>
    </div>
    <?php BoxWidget::end(); ?>

    <?php BoxWidget::begin(['title' => 'Colony data']); ?>
        <?php foreach ($colony->pins as $pin): ?>
            <div id="<?= $pin->pinId ?>" style="display: none;" class="colony-pin-data">
                <table class="table table-striped">
                    <tr>
                        <td><strong>Name</strong></td>
                        <td><?= $pin->type()->name; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        <td><?= $pin->type()->description ?></td>
                    </tr>
                    <?php if ($pin->isStorageFacility()): ?>
                        <tr>
                            <td><strong>Contents</strong></td>
                            <td>
                                <?php if (!$pin->contents): ?>
                                    <div class="note note-info">Storage is empty</div>
                                <?php else: ?>
                                    <table width="100%">
                                    <?php foreach ($pin->contents as $pinContent): ?>
                                        <tr>
                                            <td><?= Html::img($pinContent->type()->image(32)); ?></td>
                                            <td><?= $pinContent->type()->name; ?></td>
                                            <td><?= $pinContent->amount; ?></td>
                                            <td><?= number_format($pinContent->type()->volume * $pinContent->amount) ?> m3</td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </table>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Capacity</strong></td>
                            <td>
                                <?php if (!$pin->contents): ?>
                                    <?= $pin->type()->capacity; ?> m3 (0 %)
                                <?php else: ?>
                                    <?= $pin->type()->capacity; ?> m3
                                    (<?= floor($pin->type()->capacity / $pin->getContentsVolume()); ?> %)
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php elseif ($pin->isStorageFacility()): ?>

                    <?php endif; ?>
                </table>
            </div>
        <?php endforeach; ?>
    <?php BoxWidget::end(); ?>
</div>
