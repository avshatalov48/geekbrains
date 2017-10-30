<?php
include "../config/main.php";
include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

$db = \app\services\Db::getInstance();

var_dump($db->queryOne("SELECT * FROM product WHERE id = :id", ['id' => 2]));

$category = new \app\models\Category();
var_dump($category);

$feedback = new \app\models\Feedback();
var_dump($feedback);

$product = new \app\models\Product();
var_dump($product);

//$user = new \app\models\User();
//var_dump($user);

$user_groups = new \app\models\User_groups();
var_dump($user_groups);

$user1 = new \app\models\User(null, 1, 'user1', '12345', 'Гадя', 'Петрович', 'gadya@mail.ru', '322-223', 'Потерялася я!');
//var_dump($user1);

$temp = $user1->getOne(14);
var_dump($temp);

/*Вывести все значения таблицы*/
//$temp = $user1->getAll();
//var_dump($temp);

/*Вставка значений в таблицу*/
$temp = $user1->insert([
    'id' => null,
    'groups_id' => 1,
    'login' => 'user1',
    'password' => '12345',
    'name' => 'Гадя',
    'surname' => 'Петрович',
    'email' => 'gadya@mail.ru',
    'phone' => '322-223',
    'description' => 'Потерялася я!'
]);

/*Изменение значений в таблице*/
$temp = $user1->update([
    'login' => 'user2',
    'password' => '123456789',
    'name' => 'Миша',
    'surname' => 'Галустян'
], 26);

/*Удалить строку с id=5*/
//$temp = $user1->delete(25);
//var_dump($temp);


/*Удалить все строки*/
//$temp = $user1->clear();
//var_dump($temp);