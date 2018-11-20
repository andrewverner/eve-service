<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 14:45
 *
 * @var \app\components\pi\Planetary $planetary
 * @var \app\components\pi\Planet[] $planets
 */

use app\assets\PIAsset;

PIAsset::register($this);

$this->title = 'Planetary Interaction';
?>
<div class="site-index">
    <div class="body-content">
        <?php if ($planets && count($planets) > 1): ?>
            <div id="mini-planets-container">
                <div class="container">
                    <div class="text-center">
                        <?php foreach ($planets as $planet): ?>
                            <?php $planetType = mb_strtolower(str_replace('Planet', '', $planet->getClass())); ?>
                            <div class="planet-cell" data-type="<?= $planetType; ?>">
                                <?= \app\components\Html::img("http://www.eveplanets.com/m/eve/img/planet_{$planetType}.jpg"); ?>
                                <div><?= ucfirst($planetType); ?></div>
                                <div class="commodities">
                                    <?php foreach ($planet->getMaterials() as $id): ?>
                                        <?php $type = \app\components\esi\EVE::universe()->type($id); ?>
                                        <?= \yii\helpers\Html::img($type->image(32), [
                                            'data-type' => $id,
                                            'data-toggle' => 'popover',
                                            'data-placement' => 'bottom',
                                            'data-content' => $type->name,
                                        ]); ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center" id="output-type">
                        <img src="" /> <span></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-12">
                <form method="get">
                    <?php \app\widgets\EvePanelWidget::begin([
                        'title' => 'What types of planets do you want to explore?',
                        'options' => ['id' => 'big-planets-container']
                    ]); ?>
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Barren',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'barren-planet', 'value' => 'BarrenPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('BarrenPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_barren.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Gas',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'gas-planet', 'value' => 'GasPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('GasPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_gas.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Ice',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'ice-planet', 'value' => 'IcePlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('IcePlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://eveplanets.com/m/eve/img/planet_ice.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Lava',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'lava-planet', 'value' => 'LavaPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('LavaPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_lava.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Oceanic',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'oceanic-planet', 'value' => 'OceanicPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('OceanicPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_oceanic.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Plasma',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'plasma-planet', 'value' => 'PlasmaPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('PlasmaPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_plasma.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Storm',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'storm-planet', 'value' => 'StormPlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('StormPlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://eveplanets.com/m/eve/img/planet_storm.jpg'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="pi-planet-container">
                                <div class="pi-planet-title">
                                    <?= \app\widgets\PrettySliderWidget::widget([
                                        'title' => 'Temperate',
                                        'name' => 'planets[]',
                                        'options' => ['id' => 'temperate-planet', 'value' => 'TemperatePlanet'],
                                        'checked' => isset($_GET['planets']) && in_array('TemperatePlanet', $_GET['planets']),
                                    ]); ?>
                                </div>
                                <div class="pi-planet-image">
                                    <?= \app\components\Html::img('http://www.eveplanets.com/m/eve/img/planet_temperate.jpg'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 text-left">
                            <input type="submit" value="Explore" class="eve-btn eve-btn-primary"/>
                        </div>
                        <div class="col-6 text-right">
                            <button class="eve-btn eve-btn-default select-all">Select all</button>
                            <button class="eve-btn eve-btn-default select-none">Select none</button>
                        </div>
                    </div>
                    <?php \app\widgets\EvePanelWidget::end(); ?>
                </form>
                <?php if ($planetary): ?>
                <div class="row">
                    <div class="col-12">
                        <?php if ($planetary->getBaseReactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Base Reactions']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($planetary->getBaseReactions() as $schematic): ?>
                                <?php $inputType = $schematic::inputTypes()[0]; ?>
                                <tr class="base-schema schema-row" data-schema="basic" data-input="<?= $inputType->type->typeId; ?>" data-output="<?= $schematic::typeId(); ?>" data-name="<?= $schematic::type()->name; ?>">
                                    <td>
                                        <?= \yii\helpers\Html::img($inputType->type->image(32)); ?>
                                    </td>
                                    <td>
                                        <?= $inputType->quantity ?> x <?= $inputType->type->name; ?>
                                    </td>
                                    <td>
                                        <?= \yii\helpers\Html::img($schematic::type()->image(32)); ?>
                                    </td>
                                    <td>
                                        <?= $schematic::quantity(); ?> x <?= \app\components\Html::a(
                                            $schematic::type()->name,
                                            Yii::$app->urlManager->createUrl("/pi/schematic/{$schematic::type()->typeId}")
                                        ); ?>
                                    </td>
                                    <td>
                                        <?= \app\components\esi\helpers\EVEFormatter::isk($schematic::type()->price()) ?> ISK
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier1Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Tear 1 Reactions']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($planetary->getTier1Reactions() as $schematic): ?>
                                    <tr class="tier1-schema schema-row" data-schema="tier1" data-input="<?= implode(',', array_keys($schematic::input())); ?>" data-output="<?= $schematic::typeId(); ?>" data-name="<?= $schematic::type()->name; ?>">
                                        <td>
                                            <table class="non-colored">
                                                <?php foreach ($schematic::inputTypes() as $inputType): ?>
                                                <tr>
                                                    <td>
                                                        <?= \yii\helpers\Html::img($inputType->type->image(32)); ?>
                                                    </td>
                                                    <td>
                                                        <?= $inputType->quantity; ?> x <?= $inputType->type->name; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach;; ?>
                                            </table>
                                        </td>
                                        <td>
                                            <?= \yii\helpers\Html::img($schematic::type()->image(32)); ?>
                                        </td>
                                        <td>
                                            <?= $schematic::quantity(); ?> x <?= \app\components\Html::a(
                                                $schematic::type()->name,
                                                Yii::$app->urlManager->createUrl("/pi/schematic/{$schematic::type()->typeId}")
                                            ); ?>
                                        </td>
                                        <td>
                                            <?= \app\components\esi\helpers\EVEFormatter::isk($schematic::type()->price()) ?> ISK
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier2Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Tear 2 Reactions']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($planetary->getTier2Reactions() as $schematic): ?>
                                    <tr class="tier2-schema schema-row" data-schema="tier2" data-input="<?= implode(',', array_keys($schematic::input())); ?>" data-output="<?= $schematic::typeId(); ?>" data-name="<?= $schematic::type()->name; ?>">
                                        <td>
                                            <table class="non-colored">
                                                <?php foreach ($schematic::inputTypes() as $inputType): ?>
                                                    <tr>
                                                        <td>
                                                            <?= \yii\helpers\Html::img($inputType->type->image(32)); ?>
                                                        </td>
                                                        <td>
                                                            <?= $inputType->quantity; ?> x <?= $inputType->type->name; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;; ?>
                                            </table>
                                        </td>
                                        <td>
                                            <?= \yii\helpers\Html::img($schematic::type()->image(32)); ?>
                                        </td>
                                        <td>
                                            <?= $schematic::quantity(); ?> x <?= \app\components\Html::a(
                                                $schematic::type()->name,
                                                Yii::$app->urlManager->createUrl("/pi/schematic/{$schematic::type()->typeId}")
                                            ); ?>
                                        </td>
                                        <td>
                                            <?= \app\components\esi\helpers\EVEFormatter::isk($schematic::type()->price()) ?> ISK
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier3Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'High-Tech Reactions']); ?>
                            <table class="eve-table colored">
                                <?php foreach ($planetary->getTier3Reactions() as $schematic): ?>
                                    <tr class="tier3-schema schema-row" data-schema="tier3" data-input="<?= implode(',', array_keys($schematic::input())); ?>" data-output="<?= $schematic::typeId(); ?>" data-name="<?= $schematic::type()->name; ?>">
                                        <td>
                                            <table class="non-colored">
                                                <?php foreach ($schematic::inputTypes() as $inputType): ?>
                                                    <tr>
                                                        <td>
                                                            <?= \yii\helpers\Html::img($inputType->type->image(32)); ?>
                                                        </td>
                                                        <td>
                                                            <?= $inputType->quantity; ?> x <?= $inputType->type->name; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;; ?>
                                            </table>
                                        </td>
                                        <td>
                                            <?= \yii\helpers\Html::img($schematic::type()->image(32)); ?>
                                        </td>
                                        <td>
                                            <?= $schematic::quantity(); ?> x <?= \app\components\Html::a(
                                                $schematic::type()->name,
                                                Yii::$app->urlManager->createUrl("/pi/schematic/{$schematic::type()->typeId}")
                                            ); ?>
                                        </td>
                                        <td>
                                            <?= \app\components\esi\helpers\EVEFormatter::isk($schematic::type()->price()) ?> ISK
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php \app\widgets\EvePanelWidget::begin([
                    'title' => 'Planetary Interaction Commodities',
                    'options' => ['id' => 'pi-chart-widget'],
                ]); ?>
                <?= \app\widgets\PlanetaryChartWidget::widget(); ?>
                <?php \app\widgets\EvePanelWidget::end(); ?>
            </div>
        </div>
    </div>
</div>
