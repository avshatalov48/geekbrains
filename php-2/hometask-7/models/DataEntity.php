<?php
namespace app\models;
use app\interfaces\IDataModel;
use app\services\Db;

abstract class DataEntity extends Model implements IDataModel
{
    public function __construct()
    {
    }
}