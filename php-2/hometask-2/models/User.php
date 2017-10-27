<?php

namespace app\models;

class User extends Model
{
    public $login;
    public $password;

    public function __construct($id = null, $login = null, $password = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    public function getTableName()
    {
        return 'users';
    }
}