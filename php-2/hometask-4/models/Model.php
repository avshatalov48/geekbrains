<?php
namespace app\models;
use app\interfaces\IModel;
use app\services\Db;

abstract class Model implements IModel
{
    public function __construct()
    {
    }

    public static function getOne($id){
        $tableName = static::getTableName();
        return static::getDb()->fetchObject(
            "SELECT * FROM {$tableName} WHERE id = :id",
            [':id' => $id],
            // get_called_class — Имя класса, полученное с помощью позднего статического связывания
            get_called_class()
        );
    }

    // Делаем метод статическим, чтобы не создавать новый объект
    public static function getAll(){
        // меняем $this на static
        $tableName = static::getTableName();
        // $this->db на static::getDb()
        return static::getDb()->fetchAll("SELECT * FROM {$tableName}");
    }

    private static function getDb(){
        return Db::getInstance();
    }
}