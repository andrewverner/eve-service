<?php
use yii\web\View;
use app\components\esi\universe\SolarSystem;
use yii\web\JqueryAsset;

/**
 * @var View $this
 * @var SolarSystem[] $solarSystems
 * @var array $relations
 * @var float $minX
 * @var float $minY
 * @var float $minZ
 * @var float $width
 * @var float $height
 */

JqueryAsset::register($this);
?>

<!--<pre>
    <?php /*print_r($relations); */?>
</pre>-->

<style>
    #map{width:100%;height:600px}
</style>
<div id="map" class="container">
    <svg width="75000" height="75000" style="background-color: #fff; transform: scale(0.2)">
        <?php foreach ($solarSystems as $solarSystem): ?>
        <circle r="5" cx="<?= $solarSystem->position['x']/100000000000000 + $minX ?>"
            cy="<?= (-1)*$solarSystem->position['z']/100000000000000 + $minZ ?>" data-title="<?= $solarSystem->name ?>"></circle>
        <text x="<?= $solarSystem->position['x']/100000000000000 + $minX ?>" y="<?= (-1)*$solarSystem->position['z']/100000000000000 + $minZ ?>">
            <?= $solarSystem->name; ?>
        </text>
        <?php endforeach; ?>
        <?php foreach ($relations as $relation): ?>
            <line
                x1="<?= $relation['from']['x']/100000000000000 + $minX ?>"
                y1="<?= (-1)*$relation['from']['z']/100000000000000 + $minZ ?>"
                x2="<?= $relation['to']['x']/100000000000000 + $minX ?>"
                y2="<?= (-1)*$relation['to']['z']/100000000000000 + $minZ ?>"
                stroke="black"
            ></line>
        <?php endforeach; ?>
    </svg>
</div>