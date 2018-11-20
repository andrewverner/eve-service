<?php
/**
 * @var \app\components\esi\universe\Type $type
 */

$this->title = "Planetary Interaction Schematic: {$type->name}";

use app\assets\TreansJSAsset;
TreansJSAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <?php \app\widgets\EvePanelWidget::begin(['title' => "Schematic: {$type->name}"]); ?>
                <div class="row">
                    <div class="col-12">
                        <div id="schematic"></div>
                    </div>
                    <div class="col-4">

                    </div>
                </div>
                <?php \app\widgets\EvePanelWidget::end() ?>
            </div>
        </div>
    </div>
</div>
