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
        <h1>Gallery</h1>
    </div>

    <?php

    /*
     * 1. Создать галерею фотографий. Она должна состоять всего из одной странички,
     * на которой пользователь видит все картинки в уменьшенном виде и форму для загрузки нового изображения.
     * При клике на фотографию она должна открыться в браузере в новой вкладке.
     * Размер картинок можно ограничивать с помощью свойства width.
     * При загрузке изображения необходимо делать проверку на тип и размер файла.
     */

/*    echo "<pre>";
    var_dump($_SERVER);
    echo "</pre>";*/

    include "./config/main.php";




    ?>

    <label class="custom-file">
        <input type="file" id="file" class="custom-file-input">
        <span class="custom-file-control"></span>
    </label>
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-01.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-01.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-02.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-02.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-03.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-03.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-04.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-04.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-05.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-05.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-06.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-06.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-01.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-01.jpg"/>
            </a>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 thumb">
            <a href="img/moscow-02.jpg" target="_blank">
                <img class="img-responsive" src="img/moscow-02.jpg"/>
            </a>
        </div>
    </div>
</div>
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>