<?php
use yii\web\View;
use yii\data\ArrayDataProvider;
use app\widgets\BoxWidget;
use yii\grid\GridView;
use app\components\esi\industry\CharacterIndustryJob;
use app\components\Html;

/**
 * @var View $this
 * @var ArrayDataProvider $dataProvider
 */
?>
<?php BoxWidget::begin(['title' => 'Industry jobs']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => '',
            'format' => 'raw',
            'value' => function (CharacterIndustryJob $job) {
                return Html::img($job->getBlueprintType()->image(32));
            }
        ],
        [
            'label' => 'Blueprint',
            'value' => function (CharacterIndustryJob $job) {
                return $job->getBlueprintType()->name;
            }
        ],
        [
            'label' => 'Status',
            'format' => 'raw',
            'value' => function (CharacterIndustryJob $job) {
                return $job->getStatusBadge();
            }
        ],
        //'completedCharacterId',
        //'completedDate',
        //'cost',
        [
            'label' => 'Ends in',
            'format' => 'raw',
            'value' => function (CharacterIndustryJob $job) {
                if ($job->endDate > new DateTime()) {
                    return $job->endDate->diff(new DateTime())->format('~ %a d %H h %I m');
                }

                return Html::tag('span', 'Complete', ['class' => 'badge bg-green']);
            }
        ],
        //'endDate',
        [
            'label' => 'Facility',
            'value' => function (CharacterIndustryJob $job) {
                return $job->getFacility()->getName() ?? 'Unknown';
            }
        ],
        //'facilityId',
        //'installerId',
        //'licensedRuns',
        //'outputLocationId',
        //'pauseDate',
        'probability',
        //'productTypeId',
        'runs',
        //'startDate',
        /*[
            'label' => 'Station',
            'value' => function (CharacterIndustryJob $job) {
                return $job->getStation()->name;
            }
        ],*/
        //'stationId',
        //'successfulRuns',
    ],
]); ?>
<?php BoxWidget::end(); ?>
