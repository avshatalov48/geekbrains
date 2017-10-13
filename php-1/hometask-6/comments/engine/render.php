<?php
require_once "../config/main.php";
require_once ENGINE_DIR . "db.php";

function displayGallery(){
    $dir = PUBLIC_DIR . "img/small/";
    $images = queryAll("SELECT * FROM images ORDER BY views DESC");
    foreach ($images as $file){
        if(file_exists($dir . $file['path'])){
            echo "<a href='photo.php?id={$file["id"]}'>
                    <img src = '/img/small/{$file["path"]}'>
                  </a>";
        }
    }
}
