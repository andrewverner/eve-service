<?php

use yii\web\View;
use app\components\esi\planetary\Planet;
use app\widgets\BoxWidget;
use yii\helpers\Html;

/**
 * @var View $this
 * @var Planet[] $planets
 */
?>
<div class="character-planetary">
    <?php $box = BoxWidget::begin(['title' => 'Planetary Interaction']); ?>
    <?php if (!$planets): ?>
        <div class="note note-info">Character doesn't have any planetary colonies</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($planets as $planet): ?>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-6">
                    <div class="character-planetary-planet">
                        <table>
                            <tr>
                                <td>
                                    <?= Html::a(
                                        Html::img($planet->image()),
                                        Yii::$app->urlManager->createUrl("/character/{$planet->ownerId}/planet/{$planet->planetId}")
                                    ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table table-striped">
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td><?= $planet->planet()->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Planet type</strong></td>
                                            <td><?= ucfirst($planet->planetType) ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Upgrade level</strong></td>
                                            <td><?= $planet->upgradeLevel; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Number of pins</strong></td>
                                            <td><?= $planet->numPins; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php var_dump($planets); ?>
        <?php foreach ($planets as $planet): ?>
            <?php var_dump($planet->planet()->type()); ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php BoxWidget::end(); ?>
</div>
