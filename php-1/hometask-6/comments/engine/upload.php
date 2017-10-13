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
        $filename = $file['name'];
        img_resize($dir . $filename, $dir . "small/{$filename}" ,200, 150);
        executeQuery("INSERT INTO images (name, path) VALUES('$filename', '$filename')");
  });
}