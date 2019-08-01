<?php
use yii\web\View;
use app\components\esi\character\Character;
use app\widgets\BoxWidget;
use app\components\esi\bookmarks\CharacterBookmarkFolder;
use app\components\esi\bookmarks\CharacterBookmark;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/**
 * @var View $this
 * @var Character $character
 * @var CharacterBookmarkFolder[] $folders
 * @var CharacterBookmark[] $bookmarks
 */
?>
<div class="character-bookmarks">
    <?php foreach ($bookmarks as $bookmarkFolderId => $bookmarkList): ?>
        <?php BoxWidget::begin(['title' => $folders[$bookmarkFolderId]->name ?? 'General folder']); ?>
            <?= GridView::widget([
                'dataProvider' => new ArrayDataProvider(['allModels' => $bookmarkList]),
                'tableOptions' => ['class' => 'table table-condensed'],
                'columns' => [
                    [
                        'label' => 'Location',
                        'format' => 'raw',
                        'value' => function (CharacterBookmark $bookmark) {
                            return sprintf(
                                '%s / %s / %s %s',
                                $bookmark->location()->constellation()->region()->name,
                                $bookmark->location()->constellation()->name,
                                $bookmark->location()->name,
                                $bookmark->location()->getFormattedSecurityStatus()
                            );
                        }
                    ],
                    [
                        'attribute' => 'label',
                        'filter' => 'trim'
                    ],
                    'created:datetime',
                    [
                        'label' => 'Created by',
                        'value' => function (CharacterBookmark $bookmark) {
                            return $bookmark->creator()->name;
                        }
                    ],
                    'notes',
                ],
            ]); ?>
        <?php BoxWidget::end(); ?>
    <?php endforeach; ?>
</div>
