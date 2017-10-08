<?php

function renderFilesGallery()
{
    echo '<div class="page-header">';
    echo '<h3>Содержимое каталога: "' . IMAGES_DIR . '"</h3>';
    echo '</div>';
    echo '<div class="row">';

    $files = scanFilesDirectory();
    if(count($files) > 0) {
        foreach ($files as $fileName) {
            $fileOriginal = IMAGES_DIR . $fileName;
            $fileThumb = IMAGES_THUMBS_DIR . $fileName;
            echo '<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 thumb">';
            echo '<a href="' . $fileOriginal . '" target="_blank">';
            echo '<img class="img-responsive" src="' . $fileThumb . '"/></a></div>';
        }
    } else {
        echo '<div class="page-header"><h4>Каталог пуст</h4></div>';
    }
    echo '</div>';
}