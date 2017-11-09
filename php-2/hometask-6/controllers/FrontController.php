<?php

namespace app\controllers;

use app\services\Request;
use app\services\RequestNotMatchException;

// Переносим основную логику из index.php во FrontController

class FrontController extends Controller
{
    // Какой  контроллер запущен, какой Action выполняется
    private $controller;
    private $action;

    private $defaultController = "Product";

    public function actionIndex()
    {
        // Request.php
        try{
            $rm = new Request();
        // Отлавливаем свой Exception
        }catch (RequestNotMatchException $e){
            echo "2";
        }

        $controllerName = $rm->getControllerName() ?: $this->defaultController;
        $this->action = $rm->getActionName();

        $this->controller = CONTROLLERS_NAMESPACE . ucfirst($controllerName) . "Controller";
        $controller = new $this->controller(
            new \app\services\renderers\TemplateRenderer()
        );
        $controller->runAction($this->action);
    }
}