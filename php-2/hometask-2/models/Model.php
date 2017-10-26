<?php

namespace app\models;

use app\Interfaces\IModel;
use app\services\Db;

/*Класс, который содержит хотя бы один абстрактный метод, должен быть определён как абстрактный.*/
abstract class Model implements IModel
{
    private $db;

    public function __construct()
    {
        $this->db = $this->getDb();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        return $this->db->queryOne("SELECT * FROM {$tableName} WHERE id = {$id}");
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        return $this->db->queryAll("SELECT * FROM {$tableName}");
    }

    private function getDb()
    {
        return new Db();
    }
}