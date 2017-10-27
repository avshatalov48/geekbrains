<?php

namespace app\models;

use app\Interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    public $id;
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