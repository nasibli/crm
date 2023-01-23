<?php

namespace backend\models;

use yii\base\Model;
use common\models\User as AuthUser;

class User extends Model
{
    public $id;
    public $email;
    public $role;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            ['id', 'integer'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'validateEmailUnique'],

            ['role', 'required'],

            [['password', 'password_repeat'], 'required',
                'when' => function($model) {
                    return empty($model->id);
                },
                'whenClient' => "function (attribute, value) {
                    return $('#user-id').val() !== '';
                }"
            ],
            ['password', 'string', 'min' => \Yii::$app->params['user.passwordMinLength']],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
        ];
    }

    public function validateEmailUnique($attribute, $params, $validator)
    {
        $user = AuthUser::findByUsername($this->$attribute);
        if ($user instanceof AuthUser) {
            if (!$this->id || ($this->id && $user->getId() !== $this->id)) {
                $this->addError($attribute, 'This email address has already been taken.');
            }
        }
    }
}
