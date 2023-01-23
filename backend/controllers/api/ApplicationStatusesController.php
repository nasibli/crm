<?php

namespace backend\controllers\api;

use backend\models\ApplicationStatus;
use yii\rest\ActiveController;

class ApplicationStatusesController extends ActiveController
{
    public $modelClass = ApplicationStatus::class;

    public function actions()
    {
        return [];
    }

    public function actionIndex(): array
    {
        return ApplicationStatus::find()->all();
    }
}
