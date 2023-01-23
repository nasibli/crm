<?php

/** @var yii\web\View $this */
/** @var \yii\data\SqlDataProvider $dataProvider */

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\bootstrap5\Html;

?>
<h1>Пользователи</h1>
<?php if (\Yii::$app->user->can('userEdit')): ?>
    <div class="row">
        <div class="col-12">
            <?= Html::a('Создать', Url::toRoute('/user/create'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php endif ?>
<?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
           'id',
           'email',
           'description',
            [
                'label' => 'Status',
                'value' => function($data) {
                    return $data['status'] == 10 ? 'Активный' : 'Неактивный';
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i']
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model['id']]);
                 },
                'buttons' => [
                    'activate'=>function ($url, $model, $key) {
                        $icon = $model['status'] == 10 ? 'fa-user-slash' : 'fa-user';
                        return Html::a("<i class=\"fa fa-fw {$icon}\"></i>",$url);
                    },
                ],
                'visibleButtons' => [
                    'update' => \Yii::$app->user->can('userEdit'),
                    'activate' => \Yii::$app->user->can('userEdit'),
                    'delete' => \Yii::$app->user->can('userEdit'),
                ],
                'template' => '{update} {delete} {activate}',
            ]
        ],
    ]);
?>
