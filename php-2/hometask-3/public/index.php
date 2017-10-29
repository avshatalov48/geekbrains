<?php
include "../config/main.php";
include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$db = \app\services\Db::getInstance();
var_dump($db->queryOne("SELECT * FROM product WHERE id = :id", ['id' => 2]));

$product = new \app\models\Product();


