<?php
/**
 * @var \yii\web\View $this
 * @var \app\models\RegForm $model
 */

use app\assets\RegistrationAsset;
RegistrationAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                <div class="eve-panel">
                    <?php $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'reg-form',
                    ]) ?>
                    <div class="eve-panel-body">
                        <div>
                            <?= $form->field($model, 'username', [
                                'template' => '{label} {input} {error}'
                            ])->textInput(); ?>
                            <?= $form->field($model, 'password1', [
                                'template' => '{label} {input} {error}'
                            ])->passwordInput(); ?>
                            <?= $form->field($model, 'password2', [
                                'template' => '{label} {input} {error}'
                            ])->passwordInput(); ?>
                            <?= $form->field($model, 'email', [
                                'template' => '{label} {input} {error}'
                            ])->textInput(); ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 text-left">
                                <a class="eve-btn eve-btn-big eve-btn-default reg-btn" href="#">Cancel</a>
                            </div>
                            <div class="col-lg-6 text-right">
                                <input type="submit" class="eve-btn eve-btn-big eve-btn-primary reg-btn" value="Authorize" />
                            </div>
                        </div>
                    </div>
                    <?php \yii\widgets\ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
