<?php
// DataEntity - Отображает данные с таблиц
// DataEntity служит у нас для хранения данных по конкретному кортежу и именно этот тип данных должен передаваться в репозиторий (не забывайте контроль типов - вещь тоже важная). В модели же можно как минимум определить методы для валидации данных.

namespace app\models;

use app\interfaces\IDataModel;
use app\services\Db;

abstract class DataEntity extends Model implements IDataModel
{
    public function __construct()
    {
    }
}