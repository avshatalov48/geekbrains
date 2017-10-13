<?php
function getConnection(){
    static $conn = null;
    if(!$conn){
        $config = include CONFIG_DIR . "db.php";
        $conn = mysqli_connect($config["host"], $config["user"], $config["password"], $config["db"]);
    }
   return $conn;
}

function executeQuery($sql){
    return mysqli_query(getConnection(), $sql);
}

function queryAll($sql){
    return mysqli_fetch_all(executeQuery($sql), MYSQLI_ASSOC);
}

function queryOne($sql){
    return queryAll($sql)[0];
}

function closeConnection(){
    mysqli_close(getConnection());
}



