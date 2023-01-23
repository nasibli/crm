<?php

namespace backend\models;

use yii\db\ActiveRecord;

class ApplicationStatus extends ActiveRecord
{
    public CONST STATUS_NEW = 1;

    public static function tableName()
    {
        return 'application_status';
    }

    public static function primaryKey()
    {
        return ['id'];
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 50],
        ];
    }
}
