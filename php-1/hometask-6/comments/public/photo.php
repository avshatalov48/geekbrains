<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";
$id = $_GET['id'];
$photo = queryOne("SELECT * FROM images WHERE id = {$id}");
executeQuery("UPDATE images SET views = views + 1 WHERE id = {$id}");

?>
<img src="/img/<?=$photo['path']?>" alt="<?=$photo['name']?>">

