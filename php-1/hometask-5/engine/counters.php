<?php

function counters($conDB, $id, $counter)
{
    if ($conDB && $id && $counter) {
        $id = (int)$id;
        $counter = (string)$counter;
        $query = "SELECT " . $counter . " FROM pictures WHERE id = " . $id;
        $resDB = mysqli_query($conDB, $query);
        $data = mysqli_fetch_all($resDB, MYSQLI_ASSOC)[0];
        $number = $data[$counter] + 1;
        $query = "UPDATE pictures SET " . $counter . " = " . $number . " WHERE id = " . $id;
        mysqli_query($conDB, $query);
    }
}