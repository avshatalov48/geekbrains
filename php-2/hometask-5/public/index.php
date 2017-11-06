<?php
include "../config/main.php";
include ROOT_DIR . "services/Autoloader.php";
spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

// Автозагрузчик Composer, который, в свою очередь, загрузит Twig. Если Twig был установлен другим способом, понадобится автозагрузчик Twig
require_once ROOT_DIR . 'vendor/autoload.php';
$loader = new Twig_Loader_Filesystem(ROOT_DIR . 'views/twig');
$twig = new Twig_Environment($loader
//    , array('cache' => '/path/to/compilation_cache',)
);

$controllerName = $_GET['c'] ?: "Product";
$actionName = $_GET['a'];

$controllerClass = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

// Создавая контроллер, мы сразу принимаем решение, какой использовать шаблонизатор
$controller = new $controllerClass(
    new \app\services\renderers\TemplateRenderer()
);

$controller->run($actionName);