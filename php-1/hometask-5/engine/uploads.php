<?php

function uploadsFiles()
{
    foreach ($_FILES as $file) {
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
        }

        echo '<div class="page-header"><h4>' . $message . '</h4></div>';
    }
}