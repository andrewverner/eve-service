<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 03.11.2018
 * Time: 12:41
 *
 * @var string $name
 * @var string $title
 * @var bool $checked
 * @var array $options
 */
?>
<div class="pretty p-switch p-fill">
    <?= \yii\helpers\Html::checkbox($name, $checked, $options); ?>
    <div class="state p-primary">
        <label><?= $title ?></label>
    </div>
</div>
