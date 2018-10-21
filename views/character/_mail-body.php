<?php
/**
 * @var \app\components\esi\mail\MailBody $mailBody
 * @var int $mailId
 * @var int $characterId
 * @var bool $write
 * @var bool $update
 */
?>
<div class="mail-body">
    <?php if ($write || $update): ?>
    <div class="mail-controls">
        <?php if ($write): ?>
            <span class="eve-btn eve-btn-primary">Respond</span>
        <?php endif; ?>
        <?php if ($update): ?>
            <?php if (!$mailBody->read): ?>
                <span class="eve-btn eve-btn-default">Mark as read</span>
            <?php endif; ?>
            <span class="eve-btn eve-btn-danger drop-mail" data-mail-id="<?= $mailId; ?>" data-character-id="<?= $characterId; ?>">Delete</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="mail-from">
        <strong>From</strong>:
        <span class="badge badge-secondary"><?= $mailBody->from->name; ?></span>
    </div>
    <div class="mail-to">
        <strong>To</strong>:
        <?php foreach ($mailBody->recipients as $recipient): ?>
            <?php if ($recipient->recipient() instanceof \app\components\esi\character\Character): ?>
                <span class="badge badge-secondary"><?= $recipient->recipient()->name; ?></span>
            <?php elseif ($recipient->recipient() instanceof \app\components\esi\corporation\Corporation): ?>
                <span class="badge badge-primary"><?= $recipient->recipient()->name; ?></span>
            <?php elseif ($recipient->recipient() instanceof \app\components\esi\alliance\Alliance): ?>
                <span class="badge badge-info"><?= $recipient->recipient()->name; ?></span>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="mail-date">
        <strong>Date</strong>: <?= $mailBody->timestamp->format('Y-m-d H:i:s'); ?>
    </div>
    <div class="mail-content">
        <?= strip_tags($mailBody->body, '<br><a>'); ?>
    </div>
</div>
