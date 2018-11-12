<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 02.11.2018
 * Time: 22:52
 *
 * @var string $title
 * @var string $id
 * @var string $content
 * @var string $class
 * @var \app\models\ModalButton[] $buttons
 */
?>
<div class="modal eve-modal" tabindex="-1" role="dialog" id="<?= $id; ?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php if ($title): ?>
            <div class="modal-header">
                <h5 class="modal-title"><?= $title; ?></h5>
            </div>
            <?php endif; ?>
            <div class="modal-body">
                <?= $content; ?>
            </div>
            <?php if (!empty($buttons)): ?>
            <div class="modal-footer">
                <?php foreach ($buttons as $button): ?>
                    <button type="button" <?= implode(' ', $button->getOptions()) ?>><?= $button->title; ?></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
