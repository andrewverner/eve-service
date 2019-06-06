<?php
use yii\web\View;
use app\components\esi\assets\CharacterAssetsList;
use app\components\esi\assets\CharacterAssetItem;
use app\widgets\BoxWidget;
use app\components\esi\EVE;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/**
 * @var View $this
 * @var CharacterAssetsList $assets,
 * @var array $locations
 */
?>
<?php if ($assets->isEmpty()): ?>
    <div class="alert alert-info">Assets list is empty</div>
<?php else: ?>
    <?php if ($assets->stations): ?>
        <?php foreach ($assets->stations as $stationId => $assetsList): ?>
            <?php BoxWidget::begin(['title' => EVE::universe()->station($stationId)->name]) ?>
                <?= GridView::widget([
                    'dataProvider' => new ArrayDataProvider([
                        'allModels' => $assetsList
                    ]),
                    'columns' => [
                        [
                            'label' => '',
                            'format' => 'raw',
                            'value' => function (CharacterAssetItem $assetItem) {
                                return Html::img($assetItem->type->image(32));
                            }
                        ],
                        [
                            'label' => 'Type',
                            'value' => function (CharacterAssetItem $assetItem) {
                                return $assetItem->type->name;
                            }
                        ],
                        'quantity',
                        'locationFlag',
                    ],
                ]); ?>
            <?php BoxWidget::end(); ?>
        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
