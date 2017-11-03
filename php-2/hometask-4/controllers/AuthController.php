<?php

namespace app\controllers;

use app\models\Auth;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $auth = (object)array('message' => 'Вы не авторизованы на сайте!');
        echo $this->render("form", ['auth' => $auth]);
    }

    public function actionLogin()
    {
        $this->useLayout = true;
        $login = $_GET['login'];
        $pass = $_GET['pass'];
        if ($login && $pass) {
            $query = "SELECT * FROM users WHERE login = '{$login}' AND password = '{$pass}'";
            $auth = Auth::freeQuery($query)[0];
            if ($auth) {
                $auth->message = 'Авторизация прошла успешно!';
                echo $this->render("auth", ['auth' => $auth]);
            } else {
                $this->actionIndex();
            }
        }
    }

}