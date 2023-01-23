<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Application $model */
/** @var \app\models\ApplicationStatus $statuses */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Заявка';

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form_user_create']); ?>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="request-id">id:</label>
                    <span id="request-id"> <?= $model['id'] ?> </span>
                </div>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="name">Name:</label>
                    <span id="name"> <?= Html::encode($model['name']) ?> </span>
                </div>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="customer_name">Customer Name:</label>
                    <span id="customer_name"> <?= Html::encode($model['customer_name']) ?> </span>
                </div>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="product_name">Product:</label>
                    <span id="product_name"> <?= Html::encode($model->product->name) ?> </span>
                </div>
                <?= $form->field($model, 'status_id')->dropDownList(ArrayHelper::map($statuses, 'id', 'name')) ?>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="price">Price:</label>
                    <span id="price"> <?= Html::encode($model['price']) ?> </span>
                </div>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="phone">Phone:</label>
                    <span id="phone"> <?= Html::encode($model['phone']) ?> </span>
                </div>
                <div class="mb-3 field-user-id">
                    <label class="form-label " for="comment">Comment:</label>
                    <br />
                    <span id="comment"> <?= Html::encode($model['comment']) ?> </span>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Вернуться к списку', Url::toRoute('/applications'),['class' => 'btn btn-default']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
