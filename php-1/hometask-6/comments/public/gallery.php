<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
require_once ENGINE_DIR . "render.php";
require_once ENGINE_DIR . "upload.php";

uploadImg();
displayGallery();
?>

<form action="" enctype="multipart/form-data" method = "post">
    <input type="file" name="file"/>
    <input type="submit"/>
</form>