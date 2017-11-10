<?php

namespace app\controllers;

use app\services\Request;
use app\services\RequestNotMatchException;
use app\services\AutoloaderNotMatchException;

// Переносим основную логику из index.php во FrontController

class FrontController extends Controller
{
    // Какой  контроллер запущен, какой Action выполняется
    private $controller;
    private $action;

    private $defaultController = "Product";

    public function redirect() {
//        $redirect = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/' . strtolower($this->defaultController);
        $redirect = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/service/error404';
        header('location:' . $redirect);
        exit;
    }

    public function actionIndex()
    {
        // Request.php
        try{
            $rm = new Request();
        }catch (RequestNotMatchException $e){
            $this->redirect();
        }

        $controllerName = $rm->getControllerName() ?: $this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";

        // Ловим несуществующий Controller
        try {
            $controller = new $this->controller(
                new \app\services\renderers\TemplateRenderer()
            );
        } catch (AutoloaderNotMatchException $e) {
            $this->redirect();
        }

        // Ловим несуществующий Action
        try {
            $controller->runAction($this->action);
        } catch (ActionNotMatchException $e) {
            $this->redirect();
        }

    }
}