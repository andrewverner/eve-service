<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\character\Character $character
 * @var array $route
 * @var \app\models\CharacterRoute[] $models
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
                    <?php if ($models): ?>
                        <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Saved routes']); ?>
                        <table class="eve-table">
                            <?php foreach ($models as $model): ?>
                                <tr>
                                    <td><?= $model->created; ?></td>
                                    <td><?= $model->name; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <?php \app\widgets\CharacterPanelWidget::end(); ?>
                    <?php endif; ?>
                    <?php \app\widgets\CharacterPanelWidget::begin(['title' => 'Routes recorder']); ?>
                    <div>
                        <span class="eve-btn eve-btn-primary" id="start-recording"><i class="fas fa-play-circle"></i> Start recording</span>
                        <span class="eve-btn eve-btn-default hidden" id="stop-recording"><i class="fas fa-stop-circle"></i> Stop recording</span>
                        <span class="eve-btn eve-btn-primary<?= empty($route) ? ' hidden' : '' ?>" id="save-route"><i class="fas fa-save"></i> Save route</span>
                        <span class="eve-btn eve-btn-danger<?= empty($route) ? ' hidden' : '' ?>" id="clear-route"><i class="fas fa-trash-alt"></i> Clear route</span>
                    </div>
                    <div class="recorder-options">
                        <div class="pretty p-switch p-fill">
                            <?= \yii\helpers\Html::checkbox('record-stations', false, ['id' => 'record-stations']); ?>
                            <div class="state p-primary">
                                <label>Record stations</label>
                            </div>
                        </div>
                        <div class="pretty p-switch p-fill">
                            <?= \yii\helpers\Html::checkbox('record-wormholes', false, ['id' => 'record-wormholes']); ?>
                            <div class="state p-primary">
                                <label>Record wormholes</label>
                            </div>
                        </div>
                        <div class="pretty p-switch p-fill">
                            <?= \yii\helpers\Html::checkbox('record-ship', false, ['id' => 'record-ship']); ?>
                            <div class="state p-primary">
                                <label>Record ship</label>
                            </div>
                        </div>
                    </div>
                    <div class="record-container">
                        <?php if (!empty($route)): ?>
                        <?= $this->render('route-recorder', ['route' => $route]); ?>
                        <?php endif; ?>
                    </div>
                    <?php \app\widgets\CharacterPanelWidget::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \app\widgets\EveModalWidget::begin([
    'title' => 'Save route',
    'id' => 'save-route-modal',
    'buttons' => [
        (new \app\models\ModalButton())->setClass('eve-btn eve-btn-primary')->setTitle('Save')->closeModal(true)->setId('confirm-save-route'),
        (new \app\models\ModalButton())->setClass('eve-btn eve-btn-default')->setTitle('Cancel')->closeModal(true),
    ]
]); ?>
<input type="text" class="form-control" id="route-name" placeholder="Route name" /><br />
<div class="pretty p-switch p-fill">
    <?= \yii\helpers\Html::checkbox('clear-after-save', false, ['id' => 'clear-after-save']); ?>
    <div class="state p-primary">
        <label>Clear route recorder after saving</label>
    </div>
</div>
<?php \app\widgets\EveModalWidget::end(); ?>
