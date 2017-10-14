<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "upload.php";
require_once ENGINE_DIR . "auth.php";
require_once ENGINE_DIR . "category.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];
}

echo "<h2>Админка</h2>";

if (authentication($login, $password)) {
    uploadImg();
    /*<Форма загрузки нового товара>*/
    echo '<b>Загрузить новый товар:</b><br>
    <form action="" enctype="multipart/form-data" method = "post">
        Название: <input name="name" type="text"/><br>
        Краткое описание: <textarea name="short_description" cols="30" rows="5"></textarea><br> 
        Описание: <textarea name="description" cols="30" rows="10"></textarea><br>
        Цена: <input name="price" type="text"/><br>
        Категория:' . selectCategory() . '<br>
        Изображение: <input name="file" type="file"/><br>
        <input name="login" type="hidden" value="' . $login . '"/>
        <input name="password" type="hidden" value="' . $password . '"/>
        <input value="Сохранить" type="submit"/>
    </form>';
} else {
    /*<Форма аутентификации*/
    echo "Введите логин и пароль для входа в админку (admin, 123)";
    echo '<form action="" method = "post">
    Логин: <input name="login" type="text"/><br>
    Пароль: <input name="password" type="password"/><br>
    <input value="Войти" type="submit"/>
    </form>';
}