<?php
include "../config/main.php";
include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$controllerName = $_GET['c'] ?: "Product";
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

// Создавая контроллер, мы сразу принимаем решение, какой использовать шаблонизатор
$controller = new $controllerClass(
    new \app\services\renderers\TemplateRenderer()
);

$controller->run($actionName);


