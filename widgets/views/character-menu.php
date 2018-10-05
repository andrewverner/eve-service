<ul class="character-menu">
    <?php foreach ($menu as $title => $link): ?>
        <li><?= \yii\helpers\Html::a($title, $link); ?></li>
    <?php endforeach; ?>
</ul>
