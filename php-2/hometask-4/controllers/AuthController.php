<?php

// Добавляем имя класса к Controller, чтобы понимать, что речь идет именно об этом компоненте

namespace app\controllers;

use app\models\Auth;

class AuthController extends Controller
{
    public function actionIndex()
    {
        echo "<h3>Вы не авторизованы на сайте!</h3>";
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