<?php
namespace app\models;

use app\models\repositories\SessionsRep;
use app\models\repositories\UserRep;
use app\services\Auth;

// В будущем, логику лучше вынести в отдельный компонент, т.к. мы следуем принципу "единственности-ответственности"
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

    // Возвращает текущего пользователя, если он авторизован
    public function getCurrent()
    {
        if($userId = $this->getUserId()){

            return (new UserRep())->getById($userId);
        }
        return null;
    }

    // Получение User Id
    public function getUserId()
    {
        // Сначала получаем SessionId
        $sid = (new Auth())->getSessionId();
        if(!is_null($sid)){
            // А из SessionId получаем UserId
            return (new SessionsRep())->getUidBySid($sid);
        }
        return null;
    }
}