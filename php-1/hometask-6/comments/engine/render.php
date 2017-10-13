<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";
require_once ENGINE_DIR . "comments.php";

function displayGallery()
{
    $dir = PUBLIC_DIR . "img/small/";
    $images = queryAll("SELECT * FROM images ORDER BY views DESC");
    foreach ($images as $file) {
        if (file_exists($dir . $file['path'])) {
            /*Вывод фото*/
            echo "<a href='photo.php?id={$file["id"]}'><img src = '{$dir}{$file["path"]}' title='Кликните для увеличения фото'></a>";
            /*Вывод комментариев*/
            displayComments($file['id']);
        }
    }
}