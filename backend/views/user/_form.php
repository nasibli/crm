<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \backend\models\User $model */
/** @var \yii\rbac\Role[] $roles */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form_user_create']); ?>
            <?php if($model->id):?>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="user-id">id:</label>
                    <span id="user-id"> <?= $model->id ?> </span>
                </div>
            <?php endif ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map($roles, 'name', 'description')) ?>
            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_repeat')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Вернуться к списку', Url::toRoute('/users'),['class' => 'btn btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
