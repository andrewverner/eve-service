<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 18.11.2018
 * Time: 14:45
 *
 * @var \app\components\pi\Planetary $planetary
 */

use app\assets\PIAsset;

PIAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-12">
                <form method="get">
                    <?php \app\widgets\EvePanelWidget::begin(['title' => 'What types of planets do you want to explore?']); ?>
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
                        <div class="col-12">
                            <input type="submit" value="Explore" class="eve-btn eve-btn-primary"/>
                        </div>
                        <?php \app\widgets\EvePanelWidget::end(); ?>
                    </div>
                </form>
                <?php if ($planetary): ?>
                <div class="row">
                    <div class="col-12">
                        <?php if ($planetary->getBaseReactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Base Reactions']); ?>
                            <table class="eve-table">
                                <?php foreach ($planetary->getBaseReactions() as $output => $input): ?>
                                <tr>
                                    <td>
                                        3000 x <?= $input[0]; ?>
                                    </td>
                                    <td>
                                        20 x <?= $output; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier1Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Tear 1 Reactions']); ?>
                            <table class="eve-table">
                                <?php foreach ($planetary->getTier1Reactions() as $output => $input): ?>
                                    <tr>
                                        <td>
                                            40 x
                                        </td>
                                        <td>
                                            <?= \app\components\Html::ul($input); ?>
                                        </td>
                                        <td>
                                            5 x
                                        </td>
                                        <td>
                                            <?= $output; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier2Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'Tear 2 Reactions']); ?>
                            <table class="eve-table">
                                <?php foreach ($planetary->getTier2Reactions() as $output => $input): ?>
                                    <tr>
                                        <td>
                                            10 x
                                        </td>
                                        <td>
                                            <?= \app\components\Html::ul($input); ?>
                                        </td>
                                        <td>
                                            3 x
                                        </td>
                                        <td>
                                            <?= $output; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php if ($planetary->getTier3Reactions()): ?>
                            <?php \app\widgets\EvePanelWidget::begin(['title' => 'High-Tech Reactions']); ?>
                            <table class="eve-table">
                                <?php foreach ($planetary->getTier3Reactions() as $output => $input): ?>
                                    <tr>
                                        <td>
                                            6 x
                                        </td>
                                        <td>
                                            <?= \app\components\Html::ul($input); ?>
                                        </td>
                                        <td>
                                            1 x
                                        </td>
                                        <td>
                                            <?= $output; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php \app\widgets\EvePanelWidget::end(); ?>
                        <?php endif; ?>
                        <?php /*\app\widgets\EvePanelWidget::begin(['title' => 'Reactions']); */?><!--
                        <div id="debug">
                            <?php /*var_dump($planetary->getBaseReactions()); */?>
                            <?php /*var_dump($planetary->getTier1Reactions()); */?>
                            <?php /*var_dump($planetary->getTier2Reactions()); */?>
                            <?php /*var_dump($planetary->getTier3Reactions()); */?>
                        </div>
                        --><?php /*\app\widgets\EvePanelWidget::end(); */?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
