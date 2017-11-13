<?php


namespace app\models\repositories;


use app\models\User;

class UserRep extends Repository
{
    // Чтобы каждый раз не указывать пользователя введем свойство
    // Укажем, экземпляр какого класса мы отдаем при Fetch
    protected $nestedClass = User::class;


    public function getByLoginPass($login, $pass)
    {
        //  u - это алиас для таблички user в этом запросе, чтобы кажддый раз не писать имя таблицы целиком
        $sql = "SELECT u.* FROM users u WHERE login = :login AND password = :pass";
        return $this->conn->fetchObject($sql,
            [
                // ":login" => $login, ":pass" => md5($pass)
                // Поле 'password' в 'users' должно быть в md5
                ":login" => $login, ":pass" => $pass
            ],
            $this->nestedClass
        );
    }

    // По Id выбираем пользователя
    public function getById($id)
    {
        return $this->conn->fetchObject(
            "SELECT u.* FROM users u WHERE u.id = ?", [$id], $this->nestedClass
        );
    }
}