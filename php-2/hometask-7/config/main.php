<?php
// Все переносим в единый config
// Делаем в виде массива, но можно сделать и в виде отдельного класса, чтобы это все ужесточить!
return [
    // Константы
    'root_dir' => $_SERVER['DOCUMENT_ROOT'] . "/../",
    // NameSpaces
    'controller_namespaces' => '\app\controllers\\',
    // Конфигурация отдельных компонентов приложения
    'components' => [
        'db' => [
            // ::class - зарезервированная константа, обращение к которой вернет полное имя класса
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'shop',
            'charset' => 'UTF8'
        ],
        'mainController' => [
            'class' => \app\controllers\FrontController::class
        ],
        'auth' => [
            'class' => \app\services\Auth::class
        ],
        'request' => [
            'class' => \app\services\Request::class
        ]
    ]
];