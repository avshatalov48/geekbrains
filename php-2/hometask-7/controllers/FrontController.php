<?php

namespace app\controllers;

use app\base\App;
use app\models\User;

class FrontController extends Controller
{
    private $controller;
    private $action;

    private $defaultController = "Product";

    public function actionIndex()
    {
        // Обращение к компоненту Request по имени, а не через new Request(), как раньше
        $rm = App::call()->request;

        $controllerName = $rm->getControllerName() ?: $this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = App::call()->config['controller_namespaces']
            . ucfirst($controllerName) . "Controller";
        $this->checkLogin();
        $controller = new $this->controller(
            new \app\services\renderers\TemplateRenderer()
        );
        $controller->runAction($this->action);
    }

    // Если пользователь авторизован, пускаем дальше, если нет - отправляем на страницу авторизации
    private function checkLogin(){
        // Используем сессии, чтобы при каждом заходе пользователя не спрашивать его про авторизацию
        session_start();
        // Чтобы не было бесконечного редиректа добавляем условие
        if($this->controller != "\\" . AuthController::class){
            // Успешно получен ли текущий пользователь
            $user = (new User())->getCurrent();
            // Отправляем на страницу авторизации
            if(!$user){
                $this->redirect('auth');
            }
        }
    }
}