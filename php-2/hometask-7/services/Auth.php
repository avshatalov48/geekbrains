<?php

namespace app\services;

use app\models\repositories\UserRep;
use app\models\repositories\SessionsRep;
use app\models\User;

class Auth
{
    // Ключ для хранения сессии (session Id)
    protected $sessionKey = 'sid';

    // Авторизация по логину и паролю
    public function login($login, $pass)
    {
        // Если юзера не нашли, то false
        if (!$user = (new UserRep())->getByLoginPass($login, $pass)) {
            return false;
        }
        // Если все Ок, то открываем сессию, генерируем токен
        $this->openSession($user);
        return true;
    }

    // Получение SessionId
    public function getSessionId()
    {
        // Получение ключа из сессии $_SESSION
        $sid = $_SESSION[$this->sessionKey];
        if (!is_null($sid)) {
            // Обновление времени доступа токена в БД
            (new SessionsRep())->updateLastTime($sid);
        }
        return $sid;
    }

    // Открытие сессии
    public function openSession(User $user)
    {
        // Генерация ключа
        $sid = $this->generateStr();
        // Записываем в БД с привязкой к пользователю
        (new SessionsRep())->createNew($user->id, $sid, date("Y-m-d H:i:s"));
        // Запоминаем sessionKey пользователя
        $_SESSION[$this->sessionKey] = $sid;
    }

    // Метод генерации рандомной строки
    private function generateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }
}