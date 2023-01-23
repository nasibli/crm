<?php

namespace console\controllers;

use backend\models\Application;
use backend\models\ApplicationStatus;
use backend\models\Product;
use backend\services\ApplicationService;
use Faker\Core\DateTime;
use yii\console\Controller;
use backend\services\UserService;

class InitAppController extends Controller
{
    private UserService $userService;
    private ApplicationService $applicationService;
    private $faker;

    public function __construct($id, $module, $config)
    {
        $this->userService = new UserService();
        $this->applicationService = new ApplicationService();
        $this->faker = \Faker\Factory::create();
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(?string $withData)
    {
        $this->createAdmin();
        $this->createApplicationStatuses();
        $this->createProducts();

        echo "Инициализация данных завершена успешно\n";

        if (!empty($withData)) {
            $this->createUsers();
            $this->createApplications();
        }

    }

    private function createAdmin()
    {
        $data = [
            'User' => [
                'email' => 'admin@example.com',
                'password' => '12345678',
                'password_repeat' => '12345678',
                'role' => 'Admin'
            ]
        ];

        $this->userService->create($data);
    }

    private function createProducts()
    {
        $products = ['Яблоки', 'Апельсины', 'Мандарины'];

        foreach ($products as $productName) {
            $product = new Product();
            $product->name = $productName;
            $product->save();
        }
    }

    private function createApplicationStatuses()
    {
        $statuses = ['Принята', 'Отказано', 'Брак'];

        foreach ($statuses as $status) {
            $applicationStatus = new ApplicationStatus();
            $applicationStatus->name = $status;
            $applicationStatus->save();
        }
    }

    private function createUsers()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i<100; $i++) {
            $data = [
                'User' => [
                    'email' => $faker->email(),
                    'password' => '12345678',
                    'password_repeat' => '12345678',
                    'role' => $faker->randomElement(['Admin', 'Manager'])
                ]
            ];

            $this->userService->create($data);
        }

        echo "Создание пользователей завершено успешно\n";
    }

    private function createApplications()
    {
        for ($i=0; $i < 100; $i++) {
            $application = new Application();
            $this->applicationService->create([
                'product_id' => $this->faker->randomElement([1, 2, 3]),
                'status_id' => $this->faker->randomElement([1, 2, 3]),
                'name' => $this->faker->text(50),
                'customer_name' => $this->faker->name,
                'price' => random_int(50, 500),
                'phone' => $this->faker->phoneNumber(),
                'comment' => $this->faker->realText(600)
            ]);
            $application->save();
        }

        echo "Создание заявок завершено успешно\n";
    }

}
