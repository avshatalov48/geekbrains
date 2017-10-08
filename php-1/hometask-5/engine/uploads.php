<?php

/**
 * @param $conDB
 */
function uploadsFiles($conDB)
{
    foreach ($_FILES as $file) {
//        var_dump($file);
        $fileType = explode("/", $file['type'])[0];
        if ($file['error'] != 0) {
            $message = "Произошла ошибка: " . $file['error'] . "!";
        } elseif ($fileType != "image") {
            $message = "Неверный тип файла: " . $file['name'] . "!";
        } elseif ($file['size'] > 1048576) {
            $message = "Слишком большой размер файла: " . $file['size'] . "! Не более 1Мб!";
        } else {
            $src = $file['tmp_name'];
            $original = IMAGES_DIR . $file['name'];
            $thumbs = IMAGES_THUMBS_DIR . $file['name'];
            img_resize($src, $thumbs, 240, 160);
            move_uploaded_file($src, $original);
            $message = "Загрузка файла: " . $file['name'] . " успешно выполнена!";
            /*Добавляем запись о новом файле в БД*/
            $query = "INSERT INTO pictures (path, size, name, view, click) VALUES ('" . IMAGES_DIR . "', '" . $file['size'] . "', '" . $file['name'] . "', '0', '0')";
            mysqli_query($conDB, $query);
        }

//(path, size, name) VALUES ('testuser', 123, 'test')\"

        echo '<div class="page-header"><h4>' . $message . '</h4></div>';
    }
}