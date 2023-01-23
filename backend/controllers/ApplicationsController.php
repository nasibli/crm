<?php

namespace backend\controllers;

use backend\models\ApplicationStatus;
use backend\repositories\ApplicationRepository;
use backend\services\ApplicationService;
use yii\filters\AccessControl;
use yii\web\Controller;

class ApplicationsController extends Controller
{
    private ApplicationRepository $applicationRepository;
    private ApplicationService $applicationService;

    public function __construct($id, $module, $config = [])
    {
        $this->applicationRepository = new ApplicationRepository();
        $this->applicationService = new ApplicationService();

        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['applicationView'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['status'],
                        'roles' => ['applicationStatusEdit'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index', ['dataProvider' => $this->applicationRepository->getListDataProvider()]);
    }

    public function actionStatus($id): string
    {
        $application = null;
        if ($this->request->isPost) {
            $application = $this->applicationService->changeStatus($id, $this->request->post());
        } else {
            $application = $this->applicationService->findApplication($id);
        }

        return $this->render('status', ['model' => $application, 'statuses' => ApplicationStatus::find()->all()]);
    }
}
