<?php
/**
 * @var array $scopes
 */
?>
<div class="site-index">
    <div class="body-content">

        <form method="post">
        <?= \yii\helpers\Html::checkboxList('Scopes', null, $scopes); ?>
            <div>
                <button class="btn btn-primary">Go</button>
            </div>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </form>

    </div>
</div>
