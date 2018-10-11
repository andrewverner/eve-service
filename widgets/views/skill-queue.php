<?php
/**
 * @var \app\components\esi\skills\QueuedSkill[] $queue
 */

use app\assets\SkillQueueAsset;
SkillQueueAsset::register($this);

$lastSkill = end($queue);
$firstSkill = reset($queue);

$totalTime = $lastSkill->finishDate->getTimestamp() - (new DateTime())->getTimestamp();
$firstSkill->startDate = new DateTime();
$shift = 0;
?>
<div class="skill-queue">
    <?php foreach ($queue as $skill): ?>
    <?php $currentSkillTime = $skill->finishDate->getTimestamp() - $skill->startDate->getTimestamp(); ?>
    <?php $progressWidth = $currentSkillTime/$totalTime * 100 ?>
    <div class="queued-skill">
        <div class="skill-data">
            <?= $skill->type()->name; ?> - Level <?= $skill->finishedLevel ?>.
            <span class="queued-skill-end-date"><code>Ended at <?= $skill->finishDate->format('Y-m-d H:i:s') ?></code></span>
        </div>
        <div class="skill-progress" style="left: <?= $shift ?>%; width: <?= $progressWidth ?>%"></div>
    </div>
    <?php $shift += $progressWidth; ?>
    <?php endforeach; ?>
</div>
