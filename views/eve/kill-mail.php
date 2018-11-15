<?php
/**
 * @var \app\components\esi\killmails\KillMail $killMail
 */

use app\assets\KillMailAsset;
KillMailAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <?php \app\widgets\EvePanelWidget::begin(['title' => 'Victim']); ?>
                <div class="row">
                    <div class="col-6">
                        <?= \yii\helpers\Html::img($killMail->victim->ship()->render(256)); ?>
                    </div>
                    <div class="col-12">
                        <pre style="background-color: #aaa">
                            <?php print_r(\app\components\esi\skills\SkillsExtractor::extract($killMail->victim->ship())); ?>
                            <?php /*print_r($killMail->victim->ship()->dogmaEffects()); */?><!--
                            --><?php /*print_r($killMail->victim->ship()->dogmaAttributes()); */?>
                        </pre>
                    </div>
                </div>
                <div>
                    <?php foreach ($killMail->fitting()->highSlots as $item): ?>
                    <?= \yii\helpers\Html::img($item->type()->image(64), ['title' => $item->type()->name]); ?>
                    <?php endforeach; ?>
                </div>
                <div>
                    <?php foreach ($killMail->fitting()->medSlots as $item): ?>
                        <?= \yii\helpers\Html::img($item->type()->image(64), ['title' => $item->type()->name]); ?>
                    <?php endforeach; ?>
                </div>
                <div>
                    <?php foreach ($killMail->fitting()->lowSlots as $item): ?>
                        <?= \yii\helpers\Html::img($item->type()->image(64), ['title' => $item->type()->name]); ?>
                    <?php endforeach; ?>
                </div>
                <pre id="debug">
                    <?php print_r($killMail->fitting()); ?>
                </pre>
                <?php \app\widgets\EvePanelWidget::end(); ?>
            </div>
        </div>
    </div>
</div>
