<?php
include "../config/main.php";
include "../services/Autoloader.php";
// Автолоадер Composer
include "../vendor/autoload.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

// Переносим основную логику из index.php во FrontController
(new \app\controllers\FrontController())->runAction();

// Тестирование
// http://geekbrains/product/card/?id=4