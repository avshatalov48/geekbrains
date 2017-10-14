<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";
require_once ENGINE_DIR . "comments.php";

$id = $_GET['id'];
$addcom = $_GET['addcom'];

$photo = queryOne("SELECT * FROM images WHERE id = {$id}");
executeQuery("UPDATE images SET views = views + 1 WHERE id = {$id}");

$small = ($addcom == "form") ? "small/" : "";
echo '<img src="./img/' . $small . $photo['path'] . '" alt="' . $photo['name'] . '">';

if ($addcom == "form") {
    formComments($id);
} else {
    if ($addcom) {
        addComments($id);
    }
    displayComments($id);
}

?>

<a href="gallery.php">Посмотреть все фото</a>