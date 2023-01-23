<?php

namespace backend\services;

use backend\models\Application;
use backend\models\ApplicationStatus;
use yii\web\NotFoundHttpException;

class ApplicationService
{
    public function create($data): Application
    {
        $application = new Application();
        $application->setAttributes($data);
        $application->status_id = ApplicationStatus::STATUS_NEW;
        if ($application->validate()) {
            $application->save();
        }

        return $application;
    }

    public function changeStatus($id, $data): Application
    {
        $application = $this->findApplication($id);
        $application->setAttribute('status_id', $data['Application']['status_id'] ?? null);
        if ($application->validate()) {
            $application->save();
        }

        return $application;
    }

    public function findApplication($id): Application
    {
        $application = Application::findOne(['id' => $id]);
        if (empty($application)) {
            throw new \NotFoundHttpException('Application id = ' . $id . ' was not found');
        }
        return $application;
    }
}
