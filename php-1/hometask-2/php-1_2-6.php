<?php

/*
 * 6. (*) С помощью рекурсии организовать функцию возведения числа в степень.
 * Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
 */

/*Вариант дробной степени не рассматривал*/

function power($val, $pow)
{
    /*Число в нулевой степени = 1*/
    if ($pow == 0) return 1;
    /*На ноль делить нельзя = Бесконечность*/
    if ($val == 0 && $pow < 1) return INF;
    /*Ноль в любой степени = ноль*/
    if ($val == 0) return 0;
    /*Отрицательная степень*/
    if ($pow < 1) return power(1 / $val, -$pow);
    return $val * power($val, $pow - 1);
}

/*Тестирование*/
for ($i = 0; $i < 5; $i++) {
    $val = rand(-9, 9);
    $pow = rand(-9, 9);
    echo "val = $val<br>pow = $pow<br>";
    echo "Проверка функции pow: " . pow($val, $pow) . "<br>";
    // PHP 5.6 и выше - ($a ** $b)
    echo "Проверка операции \"**\": " . ($val ** $pow) . "<br>";
    echo "Рекурсия: " . "val ^ pow = $val ^ $pow = " . power($val, $pow) . "<hr>";
}