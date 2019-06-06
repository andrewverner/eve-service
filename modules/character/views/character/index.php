<?php
use app\models\Scope;
use app\modules\character\widgets\SkillQueueWidget;
use app\widgets\BoxWidget;
use yii\web\View;

/**
 * @var View $this
 */
?>
<div class="character-index">
    <?php if (Yii::$app->character->token->can(Scope::SCOPE_SKILL_QUEUE_READ)): ?>
        <?php BoxWidget::begin(['title' => 'Skill queue']); ?>
            <?= SkillQueueWidget::widget(); ?>
        <?php BoxWidget::end(); ?>
    <?php endif; ?>
</div>
