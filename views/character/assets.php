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
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <input type="text" id="asset-search" class="form-control" />
                </div>
                <div class="col-12 eve-columns-container">
                    <?php foreach ($assets->stations as $id => $assetsList): ?>
                        <?php
                        uasort($assetsList, function ($first, $second) {
                            return $first->type->groupId <=> $second->type->groupId;
                        });
                        ?>
                        <?php $station = \app\components\esi\EVE::universe()->station($id); ?>
                        <div class="character-panel">
                            <div class="character-panel-title">
                                <?php if ($location): ?>
                                    <?php if ($online->online): ?>
                                        <i class="fas fa-map-marked-alt" data-toggle="popover" data-placement="bottom" data-content="Set destination"></i>
                                        <i class="fas fa-map-pin" data-toggle="popover" data-placement="bottom" data-content="Add waypoint"></i>
                                    <?php endif; ?>
                                    <?php $route = \app\components\esi\EVE::universe()->route($location->solarSystemId, $station->systemId)->length ?>
                                <?php endif; ?>
                                <?= $station->name ?> - <?= count($assetsList); ?> items <?php if (isset($route)): ?>(<?= $route ?> jumps)<?php endif; ?>
                            </div>
                            <div class="character-panel-body">
                                <div class="station-data">
                                    <?= \yii\helpers\Html::img("http://image.eveonline.com/Render/{$station->typeId}_64.png") ?>
                                </div>
                                <table class="table table-striped table-hover">
                                    <?php foreach ($assetsList as $item): ?>
                                        <tr class="asset-row" data-item="<?= $item->type->name; ?>">
                                            <td><?= \yii\helpers\Html::img("http://image.eveonline.com/Type/{$item->typeId}_32.png"); ?></td>
                                            <td><?= $item->type->name; ?></td>
                                            <td><?= number_format($item->quantity); ?></td>
                                            <td><?= number_format($item->quantity * $item->type->volume, 2, '.', ','); ?> m<sup>3</sup></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
