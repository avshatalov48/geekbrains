<?php

/*6. (*) С помощью рекурсии организовать функцию возведения числа в степень. Формат: function
power($val, $pow), где $val – заданное число, $pow – степень.*/

$temp = 0;
$test = false; // Переменную $test ввел для использования ф-ии с рекурсией многократно

function power($val, $pow)
{
    global $temp;
    global $test;
    if (!$test) {
        $test = true;
        $temp = 1;
    }
    $temp *= $val;
    if ($pow == 0) {
        $temp = 1;
    } elseif ($pow > 1) {
        power($val, $pow - 1);
    }
    $test = false;
    return $temp;
}

// Тестирование
for ($a = 0; $a < 5; $a++) {
    $val = rand(0, 9);
    $pow = rand(0, 9);

    echo "val = $val<br>pow = $pow<br>";
    echo "Проверка функции pow: " . pow($val, $pow) . "<br>";
    // PHP 5.6 и выше - ($a ** $b)
    echo "Проверка операции \"**\": " . ($val ** $pow) . "<br>";
    echo "Рекурсия: " . "val ^ pow = $val ^ $pow = " . power($val, $pow) . "<hr>";
}