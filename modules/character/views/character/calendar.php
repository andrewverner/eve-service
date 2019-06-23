<?php
use yii\web\View;
use app\components\esi\calendar\CharacterCalendar;

/**
 * @var View $this
 * @var CharacterCalendar[] $calendar
 */
?>
<?php foreach ($calendar as $record): ?>
<?php $record->getEvent()->getOwner(); ?>
<?php var_dump($record); ?>
<?php endforeach; ?>
