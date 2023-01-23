<?php

namespace backend\controllers;

use backend\repositories\UserRepository;
use backend\services\UserService;
use backend\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;

class UserController extends Controller
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function __construct($id, $module, $config = [])
    {
        $this->userService = new UserService();
        $this->userRepository = new UserRepository();

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
                        'roles' => ['userView'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'activate', 'delete'],
                        'roles' => ['userEdit'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', ['dataProvider' => $this->userRepository->getListDataProvider()]);
    }

    public function actionCreate()
    {
        $user = null;
        if($this->request->isPost) {
            $user = $this->userService->create($this->request->post());
            return $this->redirect(['user/update', 'id' => $user->id]);
        } else {
            $user = new User();
        }

        return $this->render('create', ['model' => $user, 'roles' => $this->userService->getRoles()]);
    }

    public function actionUpdate(int $id)
    {
        $user = null;
        if($this->request->isPost) {
            $user = $this->userService->update($this->request->post(), $id);
        } else {
            $user = $this->userService->findUser($id);
        }

        return $this->render('update', ['model' => $user, 'roles' => $this->userService->getRoles()]);
    }

    public function actionDelete(int $id)
    {
        if ($this->request->isPost) {
            $this->userService->delete($id);
            return $this->redirect('/users');
        }
    }

    public function actionActivate(int $id)
    {
        $this->userService->activate($id);
        return $this->redirect('/users');
    }
}
