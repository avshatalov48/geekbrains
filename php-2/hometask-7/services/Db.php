<?php

namespace app\services;

use app\traits\TSingleton;

class Db
{
    private $conn = null;
    private $config;

    public function __construct($driver, $host, $login, $password, $database, $charset)
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

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
        $smtp->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
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