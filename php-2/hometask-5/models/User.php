<?php
namespace app\models;

class User extends DataEntity
{
    public $id;
    public $login;
    public $password;

    /**
     * User constructor.
     * @param $id
     * @param $login
     * @param $password
     */
    public function __construct($id = null, $login = null, $password = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }

    public static function getTableName()
    {
        return 'users';
    }


}