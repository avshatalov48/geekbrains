<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Alexander Shatalov > PHP 1 > Lesson 4 > Exercise 1</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>phpGallery</h1>
    </div>

    <div class="page-header">
        <h3>Загрузка нового изображения</h3>
    </div>

    <form action="" enctype="multipart/form-data" method="post">
        <input type="file" name="file"/>
        <input type="submit" value="Загрузить"/>
    </form>

    <?php

    /*
     * 1. Создать галерею фотографий. Она должна состоять всего из одной странички,
     * на которой пользователь видит все картинки в уменьшенном виде и форму для загрузки нового изображения.
     * При клике на фотографию она должна открыться в браузере в новой вкладке.
     * Размер картинок можно ограничивать с помощью свойства width.
     * При загрузке изображения необходимо делать проверку на тип и размер файла.
     */

    /*Файл конфигурации*/
    include "../config/main.php";

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
                move_uploaded_file($file['tmp_name'], IMAGES_DIR . $file['name']);
                $message = "Загрузка файла: " . $file['name'] . " успешно выполнена!";
            }

            echo '<div class="page-header"><h4>' . $message . '</h4></div>';
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES)) {
        uploadsFiles();
    }

    function scanDirectory()
    {
        $dir = opendir(IMAGES_DIR);
        while ($filename = readdir($dir)) {
            if (!is_dir($filename)) {
                $fileType = explode("/", mime_content_type(IMAGES_DIR . $filename))[0];
                if ($fileType == "image") {
                    $files[] = $filename;
                }
            }
        }
        closedir($dir);
        return $files;
    }


    function renderGallery()
    {
        echo '<div class="page-header">';
        echo '<h3>Содержимое каталога: "' . IMAGES_DIR . '"</h3>';
        echo '</div>';
        echo '<div class="row">';

        $files = scanDirectory();
        if(count($files) > 0) {
            foreach ($files as $fileName) {
                $fileNameFull = IMAGES_DIR . $fileName;
                echo '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 thumb">';
                echo '<a href="' . $fileNameFull . '" target="_blank">';
                echo '<img class="img-responsive" src="' . $fileNameFull . '"/></a></div>';
            }
        } else {
            echo '<div class="page-header"><h4>Каталог пуст</h4></div>';
        }
        echo '</div>';
    }

    renderGallery();

    ?>

</div>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>