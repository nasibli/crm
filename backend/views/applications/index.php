<?php

/** @var yii\web\View $this */

/** @var \yii\data\SqlDataProvider $dataProvider */

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;
use yii\bootstrap5\Html;
?>
<h1>Заявки</h1>
<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'product',
        'status',
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
                'status'=>function ($url, $model, $key) {
                    return Html::a('<i class="fa-solid fa-pen-to-square"></i>',$url);
                },
            ],
            'template' => '{status}',
        ]
    ],
]);
?>
