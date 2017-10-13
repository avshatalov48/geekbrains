<?php
//require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once "../config/main.php";
$config = include ENGINE_DIR . "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    var_dump($_POST);
    $name = $_POST['name'];
    $text = $_POST['text'];
    executeQuery("INSERT INTO feedback (user_name, text) 
    VALUES('{$name}','{$text}')");
}

?>

<form action="" method="post">
    <input name="name" type="text" required/><br>
    <textarea name="text" id="" cols="30" rows="10" required></textarea><br>
    <input value="submit" type="submit"/>
</form>



