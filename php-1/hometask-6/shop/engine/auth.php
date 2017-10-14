<?php

require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";

function authentication($login, $password)
{
    return queryOne("SELECT * FROM users WHERE login = '{$login}' AND password = '{$password}'");
}