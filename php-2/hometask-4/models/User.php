<?php
namespace app\models;

class User extends Model
{
    public $id;
    public $groups_id;
    public $login;
    public $password;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $description;

    public function __construct($id = null, $groups_id = null, $login = null, $password = null, $name = null, $surname = null, $email = null, $phone = null, $description = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->groups_id = $groups_id;
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->description = $description;
    }

    public static function getTableName()
    {
        return 'users';
    }
}