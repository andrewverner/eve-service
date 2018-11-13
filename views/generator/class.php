<?php
use app\assets\RegistrationAsset;
RegistrationAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <?= \yii\helpers\Html::beginForm(); ?>
        <?= \yii\helpers\Html::textarea('model'); ?>
        <?= \yii\helpers\Html::endForm(); ?>
    </div>
</div>
