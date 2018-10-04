<?php
/**
 * @var \yii\web\View $this
 * @var array $scopes
 */

use app\assets\RegistrationAsset;
RegistrationAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <form method="post">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="eve-panel">
                        <div class="eve-panel-body">
                            <?php foreach ($scopes as $key => $title): ?>
                                <div>
                                    <div class="scope-panel">
                                        <div class="scope-key">
                                            <div class="pretty p-switch p-fill">
                                                <?= \yii\helpers\Html::checkbox("Scopes[]", false, ['value' => $key]) ?>
                                                <div class="state p-primary">
                                                    <label><?= $key; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scope-title">
                                            <?= $title; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <input type="submit" class="eve-btn eve-btn-big eve-btn-default reg-btn" value="CANCEL" />
                                </div>
                                <div class="col-md-6 text-right">
                                    <input type="submit" class="eve-btn eve-btn-big eve-btn-primary reg-btn" value="AUTHORIZE" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>
</div>
