<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 50],
        ];
    }
}
