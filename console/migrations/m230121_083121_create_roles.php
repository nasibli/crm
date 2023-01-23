<?php

use yii\db\Migration;
use yii\rbac\DbManager;

/**
 * Class m230121_083121_create_roles
 */
class m230121_083121_create_roles extends Migration
{
    private DbManager $authManager;

    public function __construct($config = [])
    {
        $this->authManager = Yii::$app->authManager;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $admin = $this->authManager->createRole('Admin');
        $admin->description = 'Администратор';
        $this->authManager->add($admin);

        $manager = $this->authManager->createRole('Manager');
        $manager->description = 'Менеджер';
        $this->authManager->add($manager);
        $this->authManager->addChild($admin, $manager);


        $userEditPermission = $this->authManager->createPermission('userEdit');
        $userEditPermission->description = 'Редактирование пользователей';
        $this->authManager->add($userEditPermission);
        $this->authManager->addChild($admin, $userEditPermission);

        $userViewPermission = $this->authManager->createPermission('userView');
        $userViewPermission->description = 'Просмотр пользователей';
        $this->authManager->add($userViewPermission);
        $this->authManager->addChild($manager, $userViewPermission);

        $applicationViewPermission = $this->authManager->createPermission('applicationView');
        $applicationViewPermission->description = 'Просмотр заявок';
        $this->authManager->add($applicationViewPermission);
        $this->authManager->addChild($manager, $applicationViewPermission);

        $applicationStatusEditPermission = $this->authManager->createPermission('applicationStatusEdit');
        $applicationStatusEditPermission->description = 'Изменение статуса заявок';
        $this->authManager->add($applicationStatusEditPermission);
        $this->authManager->addChild($manager, $applicationStatusEditPermission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DELETE FROM auth_item_child");
        $this->execute("DELETE FROM auth_rule");
        $this->execute("DELETE FROM auth_item");
    }
}
