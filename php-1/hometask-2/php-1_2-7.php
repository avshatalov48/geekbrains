<?php

/*
 * 7. (*) Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
 * 22 часа 15 минут
 * 21 час 43 минуты
 */

/* Часы */
function hourToString($hour)
{
    if ($hour == 1 || $hour == 21) {
        $hourText = "час";
    } elseif (($hour >= 2 && $hour <= 4) || ($hour >= 22 && $hour <= 24)) {
        $hourText = "часа";
    } else {
        $hourText = "часов";
    }
    return $hourText;
}

/* Минуты */
function minuteToString($minute)
{
    /* Алгоритм: 1, 21, 31, 41, 51 - всегда будет "минута".
     * Если младший разряд больше 1-го и меньше 5, при этом само число при делении на 100
     * имеет остаток больше 20 (то есть, например, не число 12 и не 112), то будут "минуты".
     * В остальных случаях "минут".
    */

    if (strlen($minute) < 2) {
        $minute = "0" . $minute;
    }

    $m = substr($minute, 1, 1);

    if ($m == 1 && $minute != 11) {
        $minuteText = "минута";
    } elseif (($minute > 1 && $minute < 5)
        || (($m > 1 && $m < 5) && (($minute % 100) > 20))
    ) {
        $minuteText = "минуты";
    } else {
        $minuteText = "минут";
    }

    return $minuteText;
}

/* Итог: Часы + Минуты */
function timeToString($hour, $minute)
{
    if ((!is_numeric($hour) || !is_numeric($minute))
        || ($hour < 0 || $hour > 24) || ($minute < 0 || $minute > 60)
    ) {
        $result = "Неверные исходные данные";
    } else {
        $result = "$hour " . hourToString($hour) . " $minute " . minuteToString($minute);
    }
    return $result;
}

/* Тестирование */
for ($i = 0; $i < 10; $i++) {
    $h = rand(0, 23);
    $m = rand(0, 59);

    $randH = time() + (7 * $h * 60 * 60);
    $randM = time() + (7 * 24 * $m * 60);

    $hour = date("H", $randH);
    $minute = date("i", $randM);
    echo "Исходные данные: $hour:$minute<br>";
    echo "Преобразованные:  " . timeToString($hour, $minute) . "<hr>";
}