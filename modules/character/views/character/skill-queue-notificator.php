<?php
use yii\web\View;
use app\models\services\SkillQueueNotificatorSettings;
use app\widgets\BoxWidget;
use yii\helpers\Html;

/**
 * @var View $this
 * @var SkillQueueNotificatorSettings $settings
 */
?>
<div class="row">
    <div class="col-lg-12">
        <?php $box = BoxWidget::begin(['title' => 'Skill queue notificator settings']); ?>

        <?= Html::beginForm(); ?>

        <div class="form-group">
            <?= Html::textInput('SkillQueueNotificatorSettings[period]', $settings->period, ['class' => 'form-control']); ?>
        </div>
        <div class="form-group">
            <?= Html::textInput('SkillQueueNotificatorSettings[emails]', $settings->emails, ['class' => 'form-control']); ?>
        </div>
        <div class="form-group">
            <?= Html::checkbox('SkillQueueNotificatorSettings[daily]', $settings->daily); ?>
        </div>
        <div class="form-group">
            <?= Html::checkbox('SkillQueueNotificatorSettings[notifyEmpty]', $settings->notifyEmpty); ?>
        </div>

        <?= Html::endForm(); ?>

        <?php BoxWidget::end(); ?>
    </div>
</div>
