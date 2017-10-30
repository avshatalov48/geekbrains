<?php

namespace app\services;

use app\traits\TSingleton;

class Db
{
    use TSingleton;

    private $conn = null;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'shop',
        'charset' => 'UTF8'
    ];

    private function getConnection()
    {
        if (is_null($this->conn)) {
            $this->conn = new \PDO(
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );

            /*
             * PDO::ATTR_DEFAULT_FETCH_MODE: Задает режим выборки данных по умолчанию.
             *
             * PDO::FETCH_ASSOC: возвращает массив, индексированный именами столбцов результирующего набора
             * PDO::FETCH_CLASS: создает и возвращает объект запрошенного класса, присваивая значения столбцов результирующего набора именованным свойствам класса, и следом вызывает конструктор, если не задан PDO::FETCH_PROPS_LATE. Если fetch_style включает в себя атрибут PDO::FETCH_CLASSTYPE (например, PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE), то имя класса, от которого нужно создать объект, будет взято из первого столбца.
             * */

            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
//            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_CLASS);

            /*
             * PDO::ATTR_ERRMODE: Режим сообщений об ошибках.
             * PDO::ERRMODE_EXCEPTION: Выбрасывать исключения.
             * */
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }

    private function query($sql, $params)
    {
        $PDOStatement = $this->getConnection()->prepare($sql);
        $PDOStatement->execute($params);
        return $PDOStatement;
    }


    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }

    public function queryOne($sql, $params = [])
    {
        return $this->queryAll($sql, $params)[0];
    }

    public function queryAll($sql, $params = [])
    {
        /*
         * http://php.net/manual/ru/pdostatement.fetchall.php
         * PDOStatement::fetchAll — Возвращает массив, содержащий все строки результирующего набора
         * */
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryObject($sql, $params = [])
    {
        /*
         * https://ruseller.com/lessons.php?id=1463
         *
         *
class User {
  public $first_name;
  public $last_name;

  public function full_name()
  {
    return $this->first_name . ' ' . $this->last_name;
  }
}

try {
  $pdo = new PDO('mysql:host=localhost;dbname=someDatabase', $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $result = $pdo->query('SELECT * FROM someTable');

  # Выводим результат как объект
  $result->setFetchMode(PDO::FETCH_CLASS, 'User');

  while($user = $result->fetch()) {
    # Вызываем наш метод full_name
    echo $user->full_name();
  }
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
         *
         *
         * */
    }


    private function prepareDsnString()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }
}