<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";
require_once ENGINE_DIR . "category.php";
require_once ENGINE_DIR . "comments.php";

$id = $_GET['id'];
$addcom = $_GET['addcom'];

$info = queryOne("SELECT * FROM product WHERE id = {$id}");

echo '<center><img src="./img/' . $info['image'] . '" alt="' . $info['name'] . '"><br><br>';
echo '<b>Название:</b> ' . $info['name'] . '<br><br>';
echo '<b>Краткое описание:</b> ' . $info['short_description'] . '<br><br>';
echo '<b>Описание:</b> ' . $info['description'] . '<br><br>';
echo '<b>Цена:</b> ' . $info['price'] . ' руб.<br><br>';
echo '<b>Категория:</b> ' . nameCategory($info['category_id']) . '<br><br><hr>';

if ($addcom == "form") {
    formComments($id);
} else {
    if ($addcom) {
        addComments($id);
    }
    displayComments($id);
}

closeConnection();
?>

<a href="index.php">Посмотреть весь каталог</a><br>
<a href="admin.php">Вход в админку</a>
</center>