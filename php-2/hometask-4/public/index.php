<?php
include "../config/main.php";
include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

// Подключение контроллера
// Controller - если не пришел, то открываем "Product"
$controllerName = $_GET['c'] ?: "Product";
// Action
$actionName = $_GET['a'];

// Формируем название класса из полученных значений
$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
// Создаем экземпляр контроллера
$controller = new $controllerClass();

$controller->run($actionName);