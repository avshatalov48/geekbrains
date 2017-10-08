<?php

function scanDB($conDB)
{
    $dir = opendir(IMAGES_THUMBS_DIR);
    while ($filename = readdir($dir)) {
        if (!is_dir($filename)) {
            $fileType = explode("/", mime_content_type(IMAGES_THUMBS_DIR . $filename))[0];
            if ($fileType == "image") {
                $files[] = $filename;
            }
        }
    }
    closedir($dir);
    return $files;
}