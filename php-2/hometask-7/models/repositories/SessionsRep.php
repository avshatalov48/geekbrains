<?php
// Репозиторий для таблицы sessions

namespace app\models\repositories;

use app\base\App;
use app\models\repositories\Repository;
use app\services\Db;

class SessionsRep extends Repository
{
    // Очистка неиспользуемых сессий, старше 20 минут
    public function clearSessions()
    {
        return $this->conn->execute(
            sprintf("DELETE FROM sessions WHERE last_update < %s", date('Y-m-d H:i:s', time() - 60 * 20))
        );
    }

    // Создаем запись в таблице sessions
    public function createNew($userId, $sid, $timeLast)
    {
        return $this->conn->execute(
            "INSERT INTO sessions(user_id, sid, last_update) VALUES (? ,? , ?)",
            [$userId, $sid, $timeLast]
        );
    }

    // Обновление времени последнего входа
    public function updateLastTime($sid, $time = null)
    {
        if (is_null($time)) {
            $time = date('Y-m-d H:i:s');
        }
        return $this->conn->execute(
            "UPDATE sessions SET last_update = '{$time}' WHERE sid = '{$sid}'");
    }

    // Получаем user_id по session_id (sid)
    public function getUidBySid($sid)
    {
        return $this->conn->fetchOne(
            "SELECT user_id FROM sessions WHERE sid = ?", [$sid]
        )['user_id'];
    }
}