<?php

function renderGallery($conDB, $id)
{
    echo '<div class="row">';

    $query = "SELECT * FROM pictures";
    $bootstrap = "col-lg-3 col-md-3 col-sm-4 col-xs-6 thumb";
    if ($id) {
        $id = (int)$id;
        $query .= " WHERE id = " . $id;
        $bootstrap = "col-lg-12 col-md-12 col-sm-12 col-xs-12 thumb";
    }
    /*Сортировка по кликам*/
    $query .= " ORDER BY click DESC";
    $resDB = mysqli_query($conDB, $query);
    $data = mysqli_fetch_all($resDB, MYSQLI_ASSOC);

    if (count($data) > 0) {
        foreach ($data as $row) {
            $fileOriginal = $row['path'] . $row['name'];
            $fileThumb = $row['path'] . "thumbs/" . $row['name'];
            echo '<div class="' . $bootstrap . '" style="text-align: center;">';

            if ($id) {
                echo '<img class="img-responsive" src="' . $fileOriginal . '"/>';
            } else {
                $url = './photo.php?click=true&id=' . $row['id'];
                $onclick = 'onclick="location.href=\'' . $url . '\'; return false;"';
                echo '<a href="' .  $url . '" target="_blank"' . $onclick . '>';
                echo '<img class="img-responsive" src="' . $fileThumb . '"/></a>';
            }

            echo '<br>Просмотры: ' . $row['view'];
            echo '<br>Переходы: ' . $row['click'];
            echo '</div>';
        }
    } else {
        echo '<div class="page-header"><h4>Изображения отсутствуют!</h4></div>';
    }
    echo '</div>';
}