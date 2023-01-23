<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */
/** @var \yii\rbac\Role[] $roles */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Редактировать пользователя';

?>

<?= $this->render('_form', [
    'model' => $model,
    'roles' => $roles,
]) ?>
