<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "render.php";
require_once ENGINE_DIR . "upload.php";

uploadImg();
displayGallery();
closeConnection();
?>

<b>Загрузить изображение:</b>
<form action="" enctype="multipart/form-data" method = "post">
    <input type="file" name="file"/>
    <input type="submit"/>
</form>