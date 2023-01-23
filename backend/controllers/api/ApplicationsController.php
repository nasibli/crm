<?php

namespace backend\controllers\api;

use backend\services\ApplicationService;
use yii\rest\ActiveController;
use backend\models\Application;

class ApplicationsController extends ActiveController
{
    private ApplicationService $applicationService;
    public $modelClass = Application::class;

    public function __construct($id, $module, $config = [])
    {
        $this->applicationService = new ApplicationService();
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

    public function actionCreate(): Application
    {
        return $this->applicationService->create($this->request->post());
    }
}
