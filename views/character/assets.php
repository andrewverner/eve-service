<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\assets\CharacterAssetsList $assets
 * @var \app\components\esi\location\CharacterLocation $location
 * @var \app\components\esi\location\CharacterOnline $online
 * @var \app\components\esi\assets\CharacterAssetItem[] $assetsList
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Assets";
?>
<div class="site-index">
    <div class="body-content">
        <?= \app\widgets\CharacterMenuWidget::widget(['characterId' => $character->characterId]); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?= \app\widgets\CharacterDataWidget::widget(['character' => $character]); ?>
                </div>
            </div>
            <div class="row">
                <!--<div class="col-12">
                    <input type="text" id="asset-search" class="form-control" />
                </div>-->
                <div class="col-12 eve-columns-container">
                    <?php foreach ($assets->stations as $id => $assetsList): ?>
                        <?php
                        uasort($assetsList, function ($first, $second) {
                            return $first->type->groupId <=> $second->type->groupId;
                        });
                        ?>
                        <?php $station = \app\components\esi\EVE::universe()->station($id); ?>
                        <?php \app\widgets\CharacterPanelWidget::begin(['title' => $station->name]); ?>
                        <div class="station-data">
                            <table class="eve-table">
                                <tr>
                                    <td>
                                        <?= \yii\helpers\Html::img("http://image.eveonline.com/Render/{$station->typeId}_64.png") ?>
                                    </td>
                                    <td>
                                        <?php if ($location): ?>
                                            <?php /*if ($online->online): */?><!--
                                                <i class="fas fa-map-marked-alt" data-toggle="popover" data-placement="bottom" data-content="Set destination"></i>
                                                <i class="fas fa-map-pin" data-toggle="popover" data-placement="bottom" data-content="Add waypoint"></i>
                                            --><?php /*endif; */?>
                                            <?php $route = \app\components\esi\EVE::universe()->route($location->solarSystemId, $station->systemId)->length ?>
                                        <?php endif; ?>
                                        <?= $station->name; ?><br />
                                        <?= $station->getSolarSystem()->name; ?> <?= $station->getSolarSystem()->getFormattedSecurityStatus(true); ?> <?php if (isset($route)): ?>(<?= $route ?> jumps)<?php endif; ?><br />
                                        <?= count($assetsList); ?> items
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table class="eve-table">
                            <?php $totalVolume = 0; ?>
                            <?php foreach ($assetsList as $item): ?>
                                <tr class="asset-row" data-item="<?= $item->type->name; ?>">
                                    <td><?= number_format($item->quantity); ?></td>
                                    <td><?= \yii\helpers\Html::img("http://image.eveonline.com/Type/{$item->typeId}_32.png"); ?></td>
                                    <td><?= $item->type->name; ?></td>
                                    <td><?= number_format($item->quantity * $item->type->volume, 2, '.', ','); ?> m<sup>3</sup></td>
                                </tr>
                                <?php $totalVolume += $item->quantity * $item->type->volume; ?>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4" class="text-right">
                                    Total volume:
                                    <?= number_format($totalVolume, 2, '.', ','); ?> m<sup>3</sup>
                                </td>
                            </tr>
                        </table>
                        <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
