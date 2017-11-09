<?php
namespace app\models\repositories;


use app\models\DataEntity;
use app\services\Db;

abstract class Repository
{
    protected $tableName;
    protected $entityClass;

    private $db;
    /**
     * DataGetter constructor.
     * @param $db
     */
    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getOne($id){

        return $this->db->fetchObject(
            "SELECT * FROM {$this->tableName} WHERE id = :id",
            [':id' => $id],
            $this->entityClass
        );
    }

    public function getAll(){
        return static::getDb()->fetchAll("SELECT * FROM {$this->tableName}");
    }

    public function update(DataEntity $entity){}

    public function create(DataEntity $entity){}

    public function delete(DataEntity $entity){}

    private static function getDb(){
        return Db::getInstance();
    }
}