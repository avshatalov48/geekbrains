<?php
namespace app\models;

use app\interfaces\IModel;
use app\services\Db;

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

    public function delete($id)
    {
        $tableName = $this->getTableName();
        return $this->db->execute("DELETE FROM {$tableName} WHERE id = {$id}", []);
    }

    public function clear()
    {
        $tableName = $this->getTableName();
        return $this->db->execute("DELETE FROM {$tableName}");
    }

    public function insert($data)
    {
        $query = '';
        foreach ($data as $column => $value) {
            $query .= "{$column}='{$value}',";
        }
        $query = substr($query, 0, strlen($query) - 1);
        $tableName = $this->getTableName();
        return $this->db->execute("INSERT INTO {$tableName} SET {$query}");
    }

    public function update($data, $id)
    {
        $query = '';
        foreach ($data as $column => $value) {
            $query .= "{$column}='{$value}',";
        }
        $query = substr($query, 0, strlen($query) - 1);
        $tableName = $this->getTableName();
        return $this->db->execute("UPDATE {$tableName} SET {$query} WHERE id={$id}");
    }

    private function getDb()
    {
        return Db::getInstance();
    }
}