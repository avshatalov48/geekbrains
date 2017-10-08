<?php

function renderGallery($conDB, $id)
{
//    echo '<div class="page-header">';
//    echo '<h3>Содержимое каталога: "' . IMAGES_DIR . '"</h3>';
//    echo '</div>';
    echo '<div class="row">';

//    $files = scanDB($conDB);

//    echo '<pre>';
//     WHERE id = :id"
    $query = "SELECT * FROM pictures";
    $bootstrap = "col-lg-3 col-md-3 col-sm-4 col-xs-6 thumb";
    if ($id) {
        $query .= " WHERE id = " . $id;
        $bootstrap = "col-lg-12 col-md-12 col-sm-12 col-xs-12 thumb";
    }
    $resDB = mysqli_query($conDB, $query);
//    var_dump($resDB);
    $data = mysqli_fetch_all($resDB, MYSQLI_ASSOC);
//    var_dump($data);

    if (count($data) > 0) {
        foreach ($data as $row) {
//            var_dump($row);
            $fileOriginal = $row['path'] . $row['name'];
            $fileThumb = $row['path'] . "thumbs/" . $row['name'];
            echo '<div class="' . $bootstrap . '">';
            echo '<a href="' . $fileOriginal . '" target="_blank">';
            echo '<img class="img-responsive" src="' . $fileThumb . '"/></a>';
            echo '<br>' . $row['view'];
            echo '<br>' . $row['click'];
            echo '<br>' . $row['description'];
            echo '</div>';
        }
    } else {
        echo '<div class="page-header"><h4>Изображения отсутствуют!</h4></div>';
    }
    echo '</div>';


//    echo '</pre>';
}