<?php

namespace backend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Application extends ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function rules()
    {
        return [
          [['product_id', 'status_id'], 'required'],
          [['product_id', 'status_id'], 'integer'],

          [['name', 'customer_name'], 'required'],
          ['name', 'string', 'max' => 50],
          ['customer_name', 'string', 'max' => 150],

          [['phone', 'price'], 'required'],
          ['price', 'integer'],
          ['phone', 'string', 'max' => 20],
          ['comment', 'string']
        ];
    }
}
