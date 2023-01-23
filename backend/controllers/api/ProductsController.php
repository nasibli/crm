<?php

namespace backend\controllers\api;

use backend\models\Product;
use yii\rest\ActiveController;

class ProductsController extends ActiveController
{
    public $modelClass = Product::class;

    public function actions()
    {
        return [];
    }

    public function actionIndex(): array
    {
        return Product::find()->all();
    }
}
