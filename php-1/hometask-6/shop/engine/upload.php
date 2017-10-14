<?php

function uploadFiles($dir = UPLOADS_DIR, $callback = null){
    if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES)){
        foreach ($_FILES as $file){
            move_uploaded_file($file['tmp_name'], $dir . $file['name']);
            if(!is_null($callback)){
                $callback($file);
            }
        }
    }
}

function uploadImg(){
    require_once VENDOR_DIR . "funcImgResize.php";
    require_once ENGINE_DIR . "db.php";

    $dir = PUBLIC_DIR . "img/";
    uploadFiles($dir, function($file) use($dir){
        $name = $_POST['name'];
        $short_description = $_POST['short_description'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];

        $filename = $file['name'];
        img_resize($dir . $filename, $dir . "small/{$filename}", 200, 150);
        /*Добавляем новый продукт в БД*/
        executeQuery("INSERT INTO product (name, image, short_description, description, price, category_id) VALUES ('$name', '$filename', '$short_description', '$description', '$price', '$category_id')");
  });
}