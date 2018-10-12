<?php
/**
 * @var \app\components\esi\mail\MailBody $mailBody
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
            <span class="eve-btn eve-btn-default">Mark as read</span>
            <span class="eve-btn eve-btn-danger">Delete</span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="mail-from">
        <strong>From</strong>:
        <span class="badge badge-secondary"><?= $mailBody->from->name; ?></span>
    </div>
    <div class="mail-to">
        <strong>To</strong>:
        <?php foreach ($mailBody->recipient as $recipient): ?>
            <?php if ($recipient->recipient() instanceof \app\components\esi\character\Character): ?>
                <span class="badge badge-secondary"><?= $recipient->recipient()->name; ?></span>
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
