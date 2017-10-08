<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Alexander Shatalov > PHP 1 > Lesson 5 > Gallery</title>
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

    /*Файлы конфигурации*/
    require_once "../config/main.php";
    $config = include CONFIG_DIR . "db.php";

    /*Библиотека - Генерация thumbnails*/
    require_once VENDOR_DIR . "funcImgResize.php";

    /*Подключение к БД*/
    $conDB = mysqli_connect($config["host"], $config["user"], $config["password"], $config["db"]);

    //    $id = $_GET['id'];

    //    if ($id) {
//        $resDB = mysqli_query($conDB, "SELECT * FROM product WHERE id = :id");
//        var_dump(mysqli_fetch_all($resDB, MYSQLI_ASSOC));
    //    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES)) {
        uploadsFiles();
    }

    renderFilesGallery();

    /*Закрытие соединения с БД*/
    mysqli_close($conDB);

    ?>

</div>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>