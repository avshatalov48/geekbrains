<?php

/*
 * 7. (*) Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
 * 22 часа 15 минут
 * 21 час 43 минуты
 */

/*1, 21, 31, 41, 51 - всегда будет "минута". Если младший разряд больше 1-го и меньше 5, при этом само число при делении на 100 имеет остаток больше 20 (то есть, например, не число 12 и не 112), то будут "минуты". В остальных случаях "минут".*/

$h = rand(0, 23);
$m = rand(0, 59);

$randH = time() + (7 * $h * 60 * 60);
$randM = time() + (7 * 24 * $m * 60);

$hour = date("H", $randH);
$minute = date("i", $randM);

echo "$hour:$minute";

$h = substr($hour, 1, 1);
switch ($h) {
    case ($h == 1 && $hour != 11):
        $hourText = "час";
        break;
    case (($h > 1 && $h < 5) || ($hour % 100 > 20)):
        $hourText = "часа";
        break;
    default:
        $hourText = "часов";
}

$m = substr($minute, 1, 1);
switch ($m) {
    case ($m == 1 && $minute != 11):
        $minuteText = "минута";
        break;
    case (($m > 1 && $m < 5) || ($minute % 100 > 20)):
        $minuteText = "минуты";
        break;
    default:
        $minuteText = "минут";
}

echo "<br>$hour $hourText $minute $minuteText";