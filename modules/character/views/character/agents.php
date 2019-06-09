<?php
use yii\web\View;
use app\components\esi\character\CharacterAgentResearch;
use app\widgets\BoxWidget;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

/**
 * @var View $this
 * @var CharacterAgentResearch[] $researches
 */
?>
<?php if (!$researches): ?>
    <div class="alert alert-info"><?= Yii::$app->character->token->character()->name ?> doesn't have any agent researches</div>
<?php else: ?>
    <?php BoxWidget::begin(['title' => 'AGents researches']); ?>
    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => $researches,
        ]),
        'columns' => [
            [
                'label' => 'Agent',
                'format' => 'raw',
                'value' => function (CharacterAgentResearch $research) {
                    var_dump($research->getAgent());
                    return sprintf('%s %s', Html::img($research->getAgent()->image(32)), $research->getAgent()->name);
                }
            ],
            [
                'label' => 'Skill',
                'value' => function (CharacterAgentResearch $research) {
                    return $research->getSkill()->name;
                }
            ],
            'pointsPerDay',
            'remainderPoints',
            'startedAt:datetime'
        ],
    ]); ?>
    <?php BoxWidget::end(); ?>
<?php endif; ?>
