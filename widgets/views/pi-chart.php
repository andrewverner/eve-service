<?php
/**
 * @var \app\components\pi\Planet[] $planets
 * @var int[] $materials
 */
?>
<div class="pi-chart-container">
    <table class="eve-table colored pi-chart">
        <tr>
            <td></td>
            <?php foreach ($materials as $materialId): ?>
                <?php $type = \app\components\pi\Material::type($materialId); ?>
                <td>
                    <div class="commodity-name">
                        <?= $type->name; ?>
                    </div>
                </td>
            <?php endforeach; ?>
        </tr>
        <tr class="commodities-row">
            <td></td>
            <?php foreach ($materials as $materialId): ?>
                <?php $type = \app\components\pi\Material::type($materialId); ?>
                <td class="commodity text-center">
                    <?= \app\components\Html::img($type->image(32), [
                        'data-type' => $type->typeId,
                        'data-toggle' => 'popover',
                        'data-placement' => 'bottom',
                        'data-content' => $type->name,
                    ]); ?>
                </td>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($planets as $planet): ?>
        <?php $planetType = mb_strtolower(str_replace('Planet', '', $planet->getClass())); ?>
        <tr data-type="<?= $planetType ?>" class="planet-row" data-commodities="<?= implode(',', $planet->getMaterials()); ?>">
            <td class="planet-type" data-commodities="<?= implode(',', $planet->getMaterials()); ?>"><?= ucfirst($planetType); ?></td>
            <?php foreach ($materials as $materialId): ?>
            <td class="planet">
                <?php if (in_array($materialId, $planet->getMaterials())): ?>
                    <?= \app\components\Html::img("http://www.eveplanets.com/m/eve/img/planet_{$planetType}.jpg", [
                        'data-type' => $planetType,
                    ]); ?>
                <?php endif; ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>