<?php
use yii\web\View;
use app\components\esi\universe\SolarSystem;
use app\components\esi\universe\SolarSystemRelation;
use app\assets\MapAsset;

/**
 * @var View $this
 * @var SolarSystem[] $solarSystems
 * @var SolarSystemRelation[] $relations
 * @var float $minX
 * @var float $minY
 * @var float $minZ
 * @var float $width
 * @var float $height
 */

MapAsset::register($this);
?>

<style>
    #map{
        overflow: hidden;
        background-color: #000;
        cursor: pointer;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    circle:hover {
        radius
    }
</style>
<div id="map" class="container">
    <svg width="<?= $width; ?>" height="<?= $height; ?>" style="background-color: #000">
        <?php foreach ($solarSystems as $solarSystem): ?>
        <circle r="4" cx="<?= $solarSystem->getX() - $minX ?>"
            cy="<?= $solarSystem->getY() - $minY ?>" data-title="<?= $solarSystem->name ?>"
            fill="<?= $solarSystem->getColor(); ?>"></circle>
        <text x="<?= $solarSystem->getX() - $minX - 15 ?>" y="<?= $solarSystem->getY() - $minY - 4 ?>" fill="<?= $solarSystem->getColor(); ?>">
            <?= $solarSystem->name; ?>
        </text>
        <?php endforeach; ?>
        <?php foreach ($relations as $relation): ?>
            <line
                x1="<?= $relation->from->getX() - $minX ?>"
                y1="<?= $relation->from->getY() - $minY ?>"
                x2="<?= $relation->to->getX() - $minX ?>"
                y2="<?= $relation->to->getY() - $minY ?>"
                stroke="<?= $relation->getColor(); ?>"
            ></line>
        <?php endforeach; ?>
    </svg>
</div>
