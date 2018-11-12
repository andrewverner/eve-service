<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 19:53
 *
 * @var array $route
 */
?>
<table class="eve-table">
<?php foreach ($route as $index => $locationData): ?>
    <?php $location = $locationData['type'] == 'station' ? \app\components\esi\EVE::universe()->station($locationData['id']) : \app\components\esi\EVE::universe()->solarSystem($locationData['id']); ?>
    <tr>
        <td><?= (new DateTime())->setTimestamp($locationData['time'])->format('Y-m-d: H:i:s'); ?></td>
        <td><?= $location->name; ?></td>
        <td>
            <?php if (isset($locationData['ship']) && $locationData['ship']): ?>
                <?= $locationData['ship']['name'] ?> (<?= $locationData['ship']['type'] ?>)
            <?php endif; ?>
        </td>
        <td><?= $locationData['type'] == 'solarSystem' ? number_format(round($location->securityStatus, 1), 1, '.', ' ') : ''; ?></td>
        <!--<td><?/*= $locationData['type'] == 'station' ? $location->stationId : $location->systemId; */?></td>-->
        <td><i class="fas fa-trash-alt drop-route-row" data-id="<?= $index; ?>"></i></td>
    </tr>
<?php endforeach; ?>
</table>
