<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <title>Alexander Shatalov > PHP 1 > Lesson 3 > Labyrinth</title>

    <style>
        body {
            width: 70%;
            margin: 0 auto;
            font-family: Consolas, Courier, monospace;
            font-size: 14px;
            color: gray;
        }

        table, tr, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0px;
        }

        table {
            border: 3px solid black;
            margin: 20px auto;
        }

        tr {
            height: 58px;
        }

        td {
            vertical-align: middle;
            text-align: center;
            width: 58px;
        }

        .wall {
            background-color: darkgrey;
        }

        .road {
            background-color: antiquewhite;
        }

        .smile {
            color: #007DC7;
            font-size: 48px;
        }

        .exit {
            color: #00838a;
            font-size: 40px;
        }

    </style>
</head>

<body>
</body>

</html>

<?php

/*
 * Написать программу, которая модулирует алгоритм выхода человека из лабиринта по методу "правой руки".
 */

/*
 * Карта
 *
 * 0 - Стена
 * 1 - Дорога
 * 2 - Смайл
 * 3 - Пройденный участок дороги
 * 4 - Выход
 * */

$map = [
    [0, 4, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 1, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 1, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 1, 0, 0, 0],
    [0, 1, 0, 0, 0, 0, 1, 0, 1, 0],
    [0, 1, 1, 1, 1, 1, 1, 0, 1, 0],
    [0, 0, 0, 0, 0, 0, 1, 0, 1, 0],
    [0, 1, 1, 1, 1, 1, 1, 1, 1, 0],
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0]
];

/* Начальные установки смайлика */
$smile = [
    "x" => "1",
    "y" => "9",
    "arrow" => "up"
];

/* Координаты выхода */
$exit = [
    "x" => "1",
    "y" => "0"
];

/* Классы CSS карты */
$class = ["wall", "road", "smile road", "road", "exit road"];

/* Отметка смайлика на карте */
function smile($smile, $map)
{
    foreach ($map as $y => $value) {
        foreach ($value as $key => $x) {
            if ($smile["x"] == $x && $smile["y"] == $y) {
                $map[$y][$x] = 2;
                return $map;
            }
        }
    }
}

/* Отрисовка карты */
function renderMap($map, $class)
{
    echo "<table>";
    foreach ($map as $tr) {
        echo "<tr>";
        foreach ($tr as $value) {
            $smile = "";
            if ($value == 2) $smile = "&#9786";
            if ($value == 3) $smile = "+";
            if ($value == 4) $smile = "&#128682;";
            echo "<td class='$class[$value]'>" . $smile . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function win($x, $y, $exit)
{
    if ($x == $exit["x"] && $y == $exit["y"]) {
        echo "<h1>Победа!</h1>";
        return true;
    }
    return false;
}

$map = smile($smile, $map);
//renderMap($map);

$arrow = $smile["arrow"];

/*Алгоритм в процессе. Переписать*/
$step = false;
$i = 1;
$reverse = 1;

do {
    $x = $smile["x"];
    $y = $smile["y"];

    if (win($x, $y, $exit)) break;

    if ($arrow == "up") {
        if ($map[$y - 1][$x] != 0 && $y > 0) {
            $map[$y][$x] = 3;
            $smile["y"] = $y - 1;
            $map[$y - 1][$x] = 2;
        } else {
            $arrow = "right";
        }
    } elseif ($arrow == "down") {
        if ($map[$y + 1][$x] != 0 && $y < 10) {
            $map[$y][$x] = 3;
            $smile["y"] = $y + 1;
            $map[$y + 1][$x] = 2;
        } else {
            $arrow = "left";
        }
    } elseif ($arrow == "right" && $x < 10) {
        if ($map[$y][$x + 1] != 0) {
            $map[$y][$x] = 3;
            $smile["x"] = $x + 1;
            $map[$y][$x + 1] = 2;
        } else {
            $arrow = "down";
        }
    } elseif ($arrow == "left" && $x > 0) {
        if ($map[$y][$x - 1] != 0) {
            $map[$y][$x] = 3;
            $smile["x"] = $x - 1;
            $map[$y][$x - 1] = 2;
        } else {
            $arrow = "up";
        }
    }

    echo "x=$x, y=$y, arrow=$arrow<br>";


} while (/*$step == false &&*/
    ++$i < 10);

renderMap($map, $class);