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
            height: 64px;
        }

        td {
            vertical-align: middle;
            text-align: center;
            width: 64px;
        }

        .wall {
            background-color: darkgrey;
        }

        .road {
            background-color: antiquewhite;
        }

        .smile {
            color: cornflowerblue;
            font-size: 50px;
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

$map = [
    [0, 1, 0, 0, 0, 0, 0, 0, 0, 0],
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

$smile = [
    "x" => "1",
    "y" => "9",
    "arrow" => "up"
];

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

function renderMap($map)
{
    echo "<table>";
    foreach ($map as $tr) {
        echo "<tr>";
        foreach ($tr as $value) {
            $smile = "";
            if ($value == 0) $class = "wall";
            if ($value == 1) $class = "road";
            if ($value == 2) {
                $class = "smile road";
                $smile = "&#9786";
            }
            if ($value == 3) {
                $class = "road";
                $smile = "+";
            }
            echo "<td class='$class'>" . $smile . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

$map = smile($smile, $map);
//renderMap($map);

$arrow = $smile["arrow"];

$step = false;
$i = 1;

do {
    $x = $smile["x"];
    $y = $smile["y"];

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

renderMap($map);