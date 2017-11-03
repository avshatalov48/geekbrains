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
        'database' => 'shopshop',
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

            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return $this->conn;
    }

    // Возвращаем объект запроса
    private function query($sql, $params)
    {
        // PDO::prepare — Подготавливает запрос к выполнению и возвращает ассоциированный с этим запросом объект
        // https://php.ru/manual/pdo.prepare.html
        $PDOStatement = $this->getConnection()->prepare($sql);
        // PDOStatement::execute — Запускает подготовленный запрос на выполнение
        // https://php.ru/manual/pdostatement.execute.html
        $PDOStatement->execute($params);
        return $PDOStatement;
    }

    public function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }

    public function fetchOne($sql, $params = [])
    {
        return $this->fetchAll($sql, $params)[0];
    }

    public function fetchAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetchObject($sql, $params = [], $class)
    {
        $smtp = $this->query($sql, $params);
        // Устанавливаем режим Fetch
        // PDO::FETCH_PROPS_LATE: если используется с PDO::FETCH_CLASS, конструктор класса будет вызван перед назначением свойств из значений столбцов.
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        // PDOStatement::fetch — Извлечение следующей строки из результирующего набора
        // https://php.ru/manual/pdostatement.fetch.html
        return $smtp->fetch();
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