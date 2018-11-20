<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 20.11.2018
 * Time: 22:07
 *
 * @var \app\components\esi\universe\SolarSystem[] $solarSystems
 */
?>
<div>
    <ul>
        <?php foreach ($solarSystems as $solarSystem): ?>
            <li>
                <?= \app\components\Html::a(
                    "{$solarSystem->name} ({$solarSystem->getFormattedSecurityStatus(true)})",
                    Yii::$app->urlManager->createUrl("/pi/{$solarSystem->systemId}")
                ) ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
