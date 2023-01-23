<?php

namespace backend\services;

use common\models\User;
use backend\models\User as CrmUser;
use yii\rbac\DbManager;
use yii\web\NotFoundHttpException;

class UserService
{
    private DbManager $authManager;

    public function __construct()
    {
        $this->authManager = \Yii::$app->authManager;
    }

    public function create(array $data)
    {
        $crmUser = new CrmUser();
        $crmUser->load($data);
        if ($crmUser->validate()) {
            $user = new User();
            $user->email = $crmUser->email;
            $user->setPassword($crmUser->password);
            $user->generateAuthKey();
            $user->save();

            $this->authManager->assign($this->authManager->getRole($crmUser->role), $user->id);
            return $user;
        } else {
            return $crmUser;
        }
    }

    public function update(array $data, int $id)
    {
        $user = $this->findAuthUser($id);
        $crmUser = new CrmUser();
        $crmUser->load($data);
        $crmUser->id = $id;

        if ($crmUser->validate()) {
            if ($crmUser->email !== $user->oldAttributes['email']) {
                $user->email = $crmUser->email;
            }
            if (!empty($crmUser->password)) {
                $user->setPassword($crmUser->password);
            }
            if (!empty($user->getDirtyAttributes())) {
                $user->save();
            }
            $role = $this->getRole($id);
            if ($crmUser->role !== $this->getRole($id)) {
                $this->authManager->revoke($this->authManager->getRole($role), $id);
                $this->authManager->assign($this->authManager->getRole($crmUser->role), $id);
            }
        }

        return $crmUser;
    }

    public function delete(int $id)
    {
        $user = $this->findAuthUser($id);

        $role = $this->getRole($id);
        $this->authManager->revoke($this->authManager->getRole($role), $id);
        $user->delete();

        return $user;
    }

    public function activate(int $id)
    {
        $user = $this->findAuthUser($id);
        if ($user->status == User::STATUS_ACTIVE) {
            $user->status = User::STATUS_INACTIVE;
        } else {
            $user->status = User::STATUS_ACTIVE;
        }

        $user->save();
    }

    public function findUser(int $id)
    {
        $user = $this->findAuthUser($id);
        $crmUser = new CrmUser();
        $crmUser->email = $user->email;
        $crmUser->id = $user->getId();
        $crmUser->role = $this->getRole($id);

        return $crmUser;
    }

    public function getRoles()
    {
        return $this->authManager->getRoles();
    }

    private function getRole(int $id) : string
    {
        $roles = $this->authManager->getRolesByUser($id);
        foreach ($roles as $name => $role) {
            return $role->name;
        }
    }

    private function findAuthUser(int $id): User
    {
        $user = User::findOne(['id' => $id]);
        if (empty($user)) {
            throw new NotFoundHttpException('User with id = ' . $id . ' not found');
        }

        return $user;
    }
}
