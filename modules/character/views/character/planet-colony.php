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
    <div style="background-image: url(/images/planetary/<?= strtolower(str_replace(['Planet (', ')'], '', $planet->type()->name)) ?>.png);
    background-position: 50% 50%; overflow-x: scroll">
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
                    <tr>
                        <td><strong>Volume</strong></td>
                        <td><?= $pin->type()->capacity ?> m3</td>
                    </tr>
                    <tr>
                        <td><strong>Contents volume</strong></td>
                        <td><?= $pin->getContentsVolume() ?> m3</td>
                    </tr>
                    <?php if ($pin->isStorageFacility() || $pin->isLaunchpad()): ?>
                        <tr>
                            <td><strong>Capacity</strong></td>
                            <td><?= $pin->getContentsVolume() * 100 / $pin->type()->capacity ?> %</td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($pin->isIndustryFacility() ): ?>
                        <tr>
                            <td><strong>Schematic</strong></td>
                            <td>
                                <?php if (!$pin->schematicOutput()): ?>
                                    <div class="note note-info">No schematic selected</div>
                                <?php else: ?>
                                    <?= Html::img($pin->schematicOutput()->image(32)) ?>
                                    <?= Html::a(
                                        $pin->schematicOutput()->name,
                                        Yii::$app->urlManager->createUrl("/pi/schematic/{$pin->schematicOutput()->typeId}"),
                                        ['target' => '_blank']
                                    ); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($pin->contents): ?>
                        <tr>
                            <td><strong>Contents</strong></td>
                            <td>
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
                            </td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        <?php endforeach; ?>
    <?php BoxWidget::end(); ?>
</div>
