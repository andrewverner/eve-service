<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\location\CharacterLocation $location
 * @var \app\components\esi\location\CharacterShip $ship
 * @var \app\components\esi\skills\QueuedSkill[] $skillQueue
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = $character->name;
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <?php if ($location): ?>
                    <div class="col-6">
                        <div class="character-panel">
                            <div class="character-panel-title">
                                <i class="fas fa-map-marker"></i> Current location
                            </div>
                            <div class="character-panel-body">
                                <div class="character-location">
                                    <?= \app\components\esi\EVE::universe()->solarSystem($location->solarSystemId)->name ?>
                                    <?php if ($location->stationId): ?>
                                        - <?= \app\components\esi\EVE::universe()->station($location->stationId)->name ?>
                                    <?php endif; ?>
                                    <?php if ($location->structureId): ?>
                                        - @TODO STRUCTURE
                                    <?php endif; ?>
                                </div>
                                <?php if ($location->stationId): ?>
                                    <div class="text-left">
                                        <?php $station = \app\components\esi\EVE::universe()->station($location->stationId) ?>
                                        <?= \yii\helpers\Html::img("http://image.eveonline.com/Render/{$station->typeId}_128.png") ?>
                                        <?php if ($ship): ?>
                                            <?= \yii\helpers\Html::img("http://image.eveonline.com/Render/{$ship->shipTypeId}_128.png") ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($skillQueue): ?>
                    <div class="col-6">
                        <div class="character-panel">
                            <div class="character-panel-title">
                                <i class="fas fa-list-ul"></i> Skill queue
                            </div>
                            <div class="character-panel-body">
                                <?php \app\widgets\SkillQueueWidget::begin(['queue' => $skillQueue]); ?>
                                <?php \app\widgets\SkillQueueWidget::end(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
