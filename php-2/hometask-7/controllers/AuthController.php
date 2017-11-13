<?php
namespace app\controllers;

use app\services\Auth;

class AuthController extends Controller
{
    public function actionIndex()
    {
        // Если приходит POST авторизуем пользователя по логину и паролю
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Если авторизация прошла успешно, происходит редирект на необходимую страницу
            if((new Auth())->login($_POST['login'], $_POST['pass'])){
                // Редирект в основном контроллере
                $this->redirect('product');
                exit;
            }
        }

        // Отрисовываем по шаблону
        echo $this->render('login');
    }
}