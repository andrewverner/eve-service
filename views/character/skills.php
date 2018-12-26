<?php
/**
 * @var \yii\web\View $this
 * @var \app\components\esi\skills\CharacterSkills $skills
 * @var \app\components\esi\character\Character $character
 * @var \app\components\esi\skills\Skill $skill
 * @var \app\models\CharacterService $service
 * @var int[] $queue
 */

use app\assets\CharacterAsset;
CharacterAsset::register($this);

$this->title = "{$character->name}: Skills";
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
            <?php if ($skills): ?>
                <div class="note note-info">
                    Total SP: <?= \app\components\esi\helpers\EVEFormatter::sp($skills->totalSp); ?>
                    <?php if ($skills->unallocatedSp): ?>
                        <br />Unallocated SP: <?= \app\components\esi\helpers\EVEFormatter::sp($skills->unallocatedSp); ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-12 eve-columns-container">
                        <?php foreach ($skills->skills() as $groupName => $skillsList): ?>
                            <?php \app\widgets\CharacterPanelWidget::begin(['title' => $groupName]); ?>
                                <table class="eve-table colored">
                                    <?php foreach ($skillsList as $skill): ?>
                                        <tr class="level-<?= $skill->trainedSkillLevel; ?>">
                                            <td style="width: 50%"><?= $skill->skill()->name; ?></td>
                                            <td style="width: 30%"><?= \app\components\esi\helpers\EVEFormatter::sp($skill->skillpointsInSkill); ?></td>
                                            <td style="width: <?= $queue ? 5 : 20 ?>%"><?= $skill->trainedSkillLevel; ?></td>
                                            <?php if ($queue): ?>
                                                <td style="width: 15%">
                                                    <?php if (in_array($skill->skillId, $queue)): ?>
                                                        <?php if ($queue[0] == $skill->skillId): ?>
                                                            In training
                                                        <?php else: ?>
                                                            Queued
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php \app\widgets\CharacterPanelWidget::end(); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="note note-info">
                    An error occurred while fetching character skills list
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
