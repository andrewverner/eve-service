<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var \app\models\CharacterRoute $model
 * @var bool $canWriteWaypoints
 */

use app\assets\RoutesAsset;
RoutesAsset::register($this);

$this->title = "{$character->name}: Routes";
?>
<div class="site-index">
    <div class="body-content">
        <?php $menu = \app\widgets\CharacterMenuWidget::begin(['characterId' => $character->characterId]); ?>
        <?php \app\widgets\CharacterMenuWidget::end(); ?>
        <div class="character-content-container">
            <div class="row">
                <div class="col-12">
                    <?= \app\widgets\CharacterDataWidget::widget(['character' => $character]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php if (!$model): ?>
                    <div class="note note-danger">
                        Route not found
                    </div>
                    <?php else: ?>
                    <?php \app\widgets\CharacterPanelWidget::begin(['title' => "Route \"{$model->name}\""]) ?>
                    <?= $this->render('route-recorder', ['route' => unserialize($model->route)]); ?>
                    <?php if($canWriteWaypoints): ?>
                        <div class="recorder-options">
                            <?= \app\widgets\PrettySliderWidget::widget([
                                'title' => 'Reverse route',
                                'name' => 'reverse-route',
                                'options' => ['id' => 'reverse-route']
                            ]); ?>
                            <?= \app\widgets\PrettySliderWidget::widget([
                                'title' => 'Use only start and end points',
                                'name' => 'start-end',
                                'options' => ['id' => 'start-end']
                            ]); ?>
                            <?= \app\widgets\PrettySliderWidget::widget([
                                'title' => 'Skip stations',
                                'name' => 'skip-stations',
                                'options' => ['id' => 'skip-stations']
                            ]); ?>
                            <?= \app\widgets\PrettySliderWidget::widget([
                                'title' => 'From my current location',
                                'name' => 'from-current-location',
                                'options' => ['id' => 'from-current-location']
                            ]); ?>
                            <?= \app\widgets\PrettySliderWidget::widget([
                                'title' => 'Clear all waypoints',
                                'name' => 'clear-waypoints',
                                'options' => ['id' => 'clear-waypoints']
                            ]); ?>
                        </div>
                        <br /><span class="eve-btn eve-btn-primary" id="set-route" data-id="<?= $model->id ?>">Set route</span>
                    <?php endif; ?>
                    <br /><br /><span class="eve-btn eve-btn-primary" id="share-route" data-id="<?= $model->id ?>">Share route</span>
                    <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \app\widgets\EveModalWidget::begin([
    'title' => 'Share route',
    'id' => 'share-route-modal',
    'buttons' => [
        (new \app\models\ModalButton())->setTitle('Close')->closeModal(true)->setClass('eve-btn eve-btn-default')
    ]
]); ?>
<div>
    <?= \app\widgets\PrettySliderWidget::widget([
        'title' => 'By link',
        'options' => [
            'id' => 'share-route-by-link',
            'data-id' => $model->id,
        ],
        'name' => 'share-route-by-link',
        'checked' => $model->share,
    ]); ?>
    <input type="text" class="form-control<?= $model->share ? '' : ' hidden' ?>" readonly value="<?= $model->getShareLink(); ?>" id="route-share-hash" />
</div>
<br />
<div>
    <div>With characters</div>
    <input type="text" class="form-control" id="character-name" placeholder="Type character name hier" />
</div>
<?php \app\widgets\EveModalWidget::end(); ?>
