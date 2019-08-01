<?php

use yii\web\View;
use app\components\esi\universe\SolarSystem;
use app\widgets\EvePanelWidget;
use yii\helpers\Html;

/**
 * @var View $this
 * @var SolarSystem $solarSystem
 */

$this->title = sprintf('Solar system: %s (%s)', $solarSystem->name, $solarSystem->getFormattedSecurityStatus());
?>
<div class="row">
    <div class="col-lg-12">
        <?php EvePanelWidget::begin([
            'title' => sprintf(
                'Solar System: %s (%s)',
                $solarSystem->name,
                $solarSystem->getFormattedSecurityStatus(true)
            ),
        ]); ?>

        <?= Html::ul([
            sprintf('%s (%s)', $solarSystem->name, $solarSystem->getFormattedSecurityStatus(true)),
            $solarSystem->constellation()->name,
            $solarSystem->constellation()->region()->name,
        ], [
            'class' => 'solar-system-bread-crumbs',
            'encode' => false,
        ]); ?>

        <pre>
            <?php print_r($solarSystem); ?>
        </pre>

        <?php EvePanelWidget::end(); ?>
    </div>
</div>
