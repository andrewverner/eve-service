<?php
/**
 * @var int $characterId
 * @var \app\components\esi\mail\CharacterMailListItem[] $list
 */
?>
<?php foreach ($list as $mail): ?>
    <div class="mail-list-record" data-mail-id="<?= $mail->mailId; ?>" data-character="<?= $characterId; ?>">
        <i class="<?= $mail->isRead ? 'far fa-envelope-open' : 'fas fa-envelope'; ?>"></i>
        <?= $mail->subject; ?>
        <code class="float-lg-right"><?= $mail->timestamp->format('Y-m-d H:i:s'); ?></code>
    </div>
<?php endforeach; ?>
