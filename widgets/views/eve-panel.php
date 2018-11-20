<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 14:42
 *
 * @var string $title
 * @var string $content
 * @var array $options
 * @var \yii\base\Widget $this
 */
?>
<div class="eve-panel"<?php if ($options): ?><?php foreach ($options as $key => $value) { echo " {$key}=\"{$value}\""; } ?><?php endif; ?>>
    <div class="eve-panel-title">
        <?= $title; ?>
    </div>
    <div class="eve-panel-body">
        <div class="eve-panel-content">
            <?= $content; ?>
        </div>
    </div>
</div>
