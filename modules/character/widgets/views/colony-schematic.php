<?php
use app\components\esi\planetary\PlanetColony;
use yii\web\View;
use app\components\esi\planetary\PlanetColonyPin;
use app\components\SVGHelper;

/**
 * @var View $this
 * @var PlanetColony $colony
 * @var PlanetColonyPin[] $pins
 * @var float $minLat
 * @var float $minLon
 * @var float $width
 * @var float $height
 */
?>
<svg width="<?= $width; ?>" height="<?= $height ?>" style="display: block; margin: auto">
    <?php foreach ($colony->links as $link): ?>
        <?php if (!isset($pins[$link->sourcePinId]) || !isset($pins[$link->destinationPinId])) { continue; } ?>
        <line x1="<?= ($pins[$link->sourcePinId]->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50 ?>"
              x2="<?= ($pins[$link->destinationPinId]->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50 ?>"
              y1="<?= ($pins[$link->sourcePinId]->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50 ?>"
              y2="<?= ($pins[$link->destinationPinId]->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50 ?>"
              stroke="#008888" stroke-dasharray="2 2" stroke-width="2"></line>
    <?php endforeach; ?>
    <?php foreach ($pins as $pin): ?>
        <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                r="15" fill="#000000"></circle>
        <?php if ($pin->isIndustryFacility()): ?>
            <svg xmlns="http://www.w3.org/2000/svg"
            x="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
            y="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
            width="24" height="24"
            viewBox="0 0 28 28"
            style="fill: <?= $pin->getPinColor(); ?>;">
                <path d="M 10.490234 2 C 10.011234 2 9.6017656 2.3385938 9.5097656 2.8085938 L 9.1757812 4.5234375 C 8.3550224 4.8338012 7.5961042 5.2674041 6.9296875 5.8144531 L 5.2851562 5.2480469 C 4.8321563 5.0920469 4.33375 5.2793594 4.09375 5.6933594 L 2.5859375 8.3066406 C 2.3469375 8.7216406 2.4339219 9.2485 2.7949219 9.5625 L 4.1132812 10.708984 C 4.0447181 11.130337 4 11.559284 4 12 C 4 12.440716 4.0447181 12.869663 4.1132812 13.291016 L 2.7949219 14.4375 C 2.4339219 14.7515 2.3469375 15.278359 2.5859375 15.693359 L 4.09375 18.306641 C 4.33275 18.721641 4.8321562 18.908906 5.2851562 18.753906 L 6.9296875 18.1875 C 7.5958842 18.734206 8.3553934 19.166339 9.1757812 19.476562 L 9.5097656 21.191406 C 9.6017656 21.661406 10.011234 22 10.490234 22 L 13.509766 22 C 13.988766 22 14.398234 21.661406 14.490234 21.191406 L 14.824219 19.476562 C 15.644978 19.166199 16.403896 18.732596 17.070312 18.185547 L 18.714844 18.751953 C 19.167844 18.907953 19.66625 18.721641 19.90625 18.306641 L 21.414062 15.691406 C 21.653063 15.276406 21.566078 14.7515 21.205078 14.4375 L 19.886719 13.291016 C 19.955282 12.869663 20 12.440716 20 12 C 20 11.559284 19.955282 11.130337 19.886719 10.708984 L 21.205078 9.5625 C 21.566078 9.2485 21.653063 8.7216406 21.414062 8.3066406 L 19.90625 5.6933594 C 19.66725 5.2783594 19.167844 5.0910937 18.714844 5.2460938 L 17.070312 5.8125 C 16.404116 5.2657937 15.644607 4.8336609 14.824219 4.5234375 L 14.490234 2.8085938 C 14.398234 2.3385937 13.988766 2 13.509766 2 L 10.490234 2 z M 12 8 C 14.209 8 16 9.791 16 12 C 16 14.209 14.209 16 12 16 C 9.791 16 8 14.209 8 12 C 8 9.791 9.791 8 12 8 z"></path>
            </svg>
        <?php elseif ($pin->isLaunchpad()):; ?>
            <svg xmlns="http://www.w3.org/2000/svg"
            x="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
            y="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
            width="24" height="24"
            viewBox="0 0 36 36"
            style="fill: <?= $pin->getPinColor(); ?>;">
                <path d="M 15 2 C 15 2 9 6 9 15 C 9 15.158852 9.0136525 15.317961 9.0234375 15.476562 C 7.9893702 16.312624 6 18.103518 6 19.544922 C 6 21.363922 7.8183594 25 7.8183594 25 L 11.119141 20.873047 L 12 23 L 18 23 L 18.880859 20.873047 L 22.181641 25 C 22.181641 25 24 21.363922 24 19.544922 C 24 18.103518 22.01063 16.312624 20.976562 15.476562 C 20.986348 15.317961 21 15.158852 21 15 C 21 6 15 2 15 2 z M 15 9 C 16.105 9 17 9.895 17 11 C 17 12.105 16.105 13 15 13 C 13.895 13 13 12.105 13 11 C 13 9.895 13.895 9 15 9 z M 12.417969 24 C 12.158969 24.334 12 24.717812 12 25.132812 C 12 27.035813 15 29 15 29 C 15 29 18 27.061812 18 25.132812 C 18 24.717813 17.841984 24.335 17.583984 24 L 16.738281 24 C 16.756281 24.077 16.800781 24.145562 16.800781 24.226562 C 16.800781 25.585562 15 26.265625 15 26.265625 C 15 26.265625 13.199219 25.585562 13.199219 24.226562 C 13.199219 24.146563 13.243719 24.077 13.261719 24 L 12.417969 24 z"></path>
            </svg>
        <?php elseif ($pin->isStorageFacility()): ?>
            <svg xmlns="http://www.w3.org/2000/svg"
                 x="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
                 y="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 40; ?>"
                 width="20" height="20"
                 viewBox="0 0 128 128"
                 style="fill: <?= $pin->getPinColor() ?>;">
                <path d="M125,28.7l-33.8-12c-0.8-0.3-1.6-0.2-2.3,0.1C87.8,17.3,29,38.1,29,38.1c-1.5,0.5-2.5,1.9-2.5,3.5v14c0,1.3,0.8,2.4,2,2.8 l7.8,2.8c2,0.7,4-0.7,4-2.8V46.7c0-1.6,1-3,2.5-3.5l53.1-18.4l19.2,6.8L63,49.9c0,0,0,0,0,0c-1.1,0.4-2,1.5-2,2.8v60.8L7,94.4V33.6 l58-20.5c1.6-0.6,2.4-2.3,1.8-3.8c-0.6-1.6-2.3-2.4-3.8-1.8L3,28.7c-1.2,0.4-2,1.6-2,2.8v65c0,1.3,0.8,2.4,2,2.8l60,21.2 c0.3,0.1,0.7,0.2,1,0.2c0.2,0,0.3,0,0.5,0c0,0,0.1,0,0.1,0c0.1,0,0.2-0.1,0.4-0.1c0,0,0,0,0,0l60-21.2c1.2-0.4,2-1.6,2-2.8v-65 c0,0,0,0,0,0C127,30.2,126.2,29.1,125,28.7z"></path>
            </svg>
        <?php elseif ($pin->isCommandCenter()): ?>
            <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                r="3" fill="#ffffff"></circle>
            <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                r="8" fill="transparent" stroke-width="1" stroke="#ffffff"></circle>

            <?= SVGHelper::arc(
                ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                19,
                280,
                80,
                [
                    'fill' => 'none',
                    'stroke' => '#880000',
                    'stroke-width' => 2,
                    'stroke-dasharray' => '2 1',
                ]
            ); ?>

            <?= SVGHelper::arc(
                ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                19,
                100,
                260,
                [
                    'fill' => 'none',
                    'stroke' => '#008888',
                    'stroke-width' => 2,
                    'stroke-dasharray' => '2 1',
                ]
            ); ?>
        <?php endif; ?>

        <?php if (($pin->isStorageFacility() || $pin->isLaunchpad()) && $pin->contents): ?>
            <?php $to = 270 + 360 * ($pin->getContentsVolume() / $pin->type()->capacity); ?>
            <?php if ($to > 360) { $to -= 360; } ?>
            <?php if ($pin->getContentsVolume() / $pin->type()->capacity >= 1): ?>
                <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                    cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                    r="19" fill="transparent" stroke="#eeeeee" stroke-width="2"></circle>
            <?php else: ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    19,
                    270,
                    $to,
                    [
                        'fill' => 'none',
                        'stroke' => '#eeeeee',
                        'stroke-width' => 2,
                    ]
                ); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($pin->isIndustryFacility()): ?>
            <?php if (count($pin->schematicInput()) <= 2): ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    25,
                    280,
                    80,
                    [
                        'fill' => 'none',
                        'stroke' => $pin->getPinColor(),
                        'stroke-width' => 3,
                    ]
                ); ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    25,
                    100,
                    260,
                    [
                        'fill' => 'none',
                        'stroke' => $pin->getPinColor(),
                        'stroke-width' => 3,
                    ]
                ); ?>
            <?php else: ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    25,
                    280,
                    20,
                    [
                        'fill' => 'none',
                        'stroke' => $pin->getPinColor(),
                        'stroke-width' => 3,
                    ]
                ); ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    25,
                    40,
                    140,
                    [
                        'fill' => 'none',
                        'stroke' => $pin->getPinColor(),
                        'stroke-width' => 3,
                    ]
                ); ?>
                <?= SVGHelper::arc(
                    ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50,
                    ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50,
                    25,
                    160,
                    260,
                    [
                        'fill' => 'none',
                        'stroke' => $pin->getPinColor(),
                        'stroke-width' => 3,
                    ]
                ); ?>
            <?php endif; ?>

            <?php if (!$pin->contents): ?>
                <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                    cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                    r="19" fill="transparent" stroke="#ee0000" stroke-width="2"></circle>
            <?php endif; ?>

            <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                r="25" fill="transparent" stroke="transparent" stroke-width="3"
                class="colony-pin" data-target="#<?= $pin->pinId; ?>" style="cursor: pointer;"></circle>
        <?php else: ?>
            <circle cx="<?= ($pin->longitude - $minLon) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                cy="<?= ($pin->latitude - $minLat) * PlanetColony::SVG_MULTIPLIER + 50; ?>"
                r="25" fill="transparent" stroke="<?= $pin->getPinColor(); ?>" stroke-width="3"
                class="colony-pin" data-target="#<?= $pin->pinId; ?>" style="cursor: pointer;"></circle>
        <?php endif; ?>
    <?php endforeach; ?>
</svg>
