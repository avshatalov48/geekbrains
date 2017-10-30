<?php
namespace app\models;

class User_groups extends Model
{
    public $id;
    public $name;

    public function __construct($id = null, $name = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
    }

    public function getTableName()
    {
        return 'user_groups';
    }
}