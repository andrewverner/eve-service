<?php
/**
 * @var \yii\web\View $this
 */

use app\assets\RegistrationAsset;
RegistrationAsset::register($this);
?>
<div class="site-index">
    <div class="body-content">
        <form method="post">
            <div class="row">
                <div class="col-6">
                    <div class="eve-panel">
                        <div class="eve-panel-body">
                            <div class="text-center">
                                <h4>Character scopes:</h4><br />
                            </div>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a href="#" class="eve-link select-all-character">Select all</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#" class="eve-link select-none-character">Select none</a>
                                </div>
                            </div>
                            <br />
                            <?php foreach (\app\models\Scope::getCharacterScopes(false) as $scope): ?>
                                <div>
                                    <div class="scope-panel">
                                        <div class="scope-key">
                                            <div class="pretty p-switch p-fill">
                                                <?= \yii\helpers\Html::checkbox("Scopes[]", false, ['value' => $scope, 'class' => 'character-scope']) ?>
                                                <div class="state p-primary">
                                                    <label><?= \app\models\Scope::SCOPE_TITLE[$scope]; ?></label>
                                                </div>
                                            </div>
                                            <i class="fas fa-question-circle scope-info" data-toggle="popover" data-placement="bottom" data-content="<?= \app\models\Scope::getScopeTitle($scope); ?>"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="eve-panel">
                        <div class="eve-panel-body">
                            <div class="text-center">
                                <h4>Corporation scopes:</h4><br />
                            </div>
                            <div>
                                <div class="note note-info">
                                    Please, note that corporation scopes are valid only if your character has roles to do so
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a href="#" class="eve-link select-all-corp">Select all</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#" class="eve-link select-none-corp">Select none</a>
                                </div>
                            </div>
                            <br />
                            <?php foreach (\app\models\Scope::CORP_SCOPES as $scope): ?>
                                <div>
                                    <div class="scope-panel">
                                        <div class="scope-key">
                                            <div class="pretty p-switch p-fill">
                                                <?= \yii\helpers\Html::checkbox("Scopes[]", false, ['value' => $scope, 'class' => 'corp-scope']) ?>
                                                <div class="state p-primary">
                                                    <label><?= \app\models\Scope::SCOPE_TITLE[$scope]; ?></label>
                                                </div>
                                            </div>
                                            <i class="fas fa-question-circle scope-info" data-toggle="popover" data-content="<?= \app\models\Scope::getScopeTitle($scope); ?>"></i>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div><br />
            <div class="row">
                <div class="col-md-4 text-left">
                    <a type="submit" class="eve-btn eve-btn-big eve-btn-default reg-btn" href="<?= Yii::$app->urlManager->createUrl('my') ?>">Cancel</a>
                </div>
                <div class="col-md-4 offset-md-4 text-right">
                    <input type="submit" class="eve-btn eve-btn-big eve-btn-primary reg-btn" value="AUTHORIZE" />
                </div>
            </div>
            <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        </form>
    </div>
</div>
