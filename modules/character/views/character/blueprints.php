<?php
use yii\web\View;
use yii\data\ArrayDataProvider;
use app\widgets\BoxWidget;
use yii\grid\GridView;
use app\components\esi\character\CharacterBlueprint;
use app\components\Html;

/**
 * @var View $this
 * @var ArrayDataProvider $dataProvider
 */
?>
<?php BoxWidget::begin(['title' => 'Blueprints']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => '',
            'format' => 'raw',
            'value' => function (CharacterBlueprint $blueprint) {
                return Html::img($blueprint->getType()->image(32));
            }
        ],
        [
            'label' => 'Item',
            'value' => function (CharacterBlueprint $blueprint) {
                return $blueprint->getType()->name;
            }
        ],
        'locationFlag',
        'locationId',
        'materialEfficiency',
        'timeEfficiency',
        [
            'label' => 'Quantity',
            'value' => function (CharacterBlueprint $blueprint) {
                return $blueprint->quantity > 0 ? $blueprint->quantity : '';
            }
        ],
        [
            'label' => 'Runs',
            'value' => function (CharacterBlueprint $blueprint) {
                return $blueprint->runs > 0 ? $blueprint->runs : 'Unlimited';
            }
        ],
        [
            'label' => 'Type',
            'value' => function (CharacterBlueprint $blueprint) {
                return $blueprint->runs == -1 ? 'Original' : 'Copy';
            }
        ],
    ],
]); ?>
<?php BoxWidget::end(); ?>
