<?php
namespace app\models;

class Auth extends Model
{
    public $id;
    public $login;
    public $password;

    public function __construct($id = null, $login = null, $password = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    public static function getTableName()
    {
       return "users";
    }
}