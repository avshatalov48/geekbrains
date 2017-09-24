<?php

/*2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора
switch организовать вывод чисел от $a до 15.*/

$a = rand(0,15);
$b = "<br>";

echo "a = $a" . $b;

switch ($a) {
    case 0:
        echo "0" . $b;
    case 1:
        echo "1" . $b;
    case 2:
        echo "2" . $b;
    case 3:
        echo "3" . $b;
    case 4:
        echo "4" . $b;
    case 5:
        echo "5" . $b;
    case 6:
        echo "6" . $b;
    case 7:
        echo "7" . $b;
    case 8:
        echo "8" . $b;
    case 9:
        echo "9" . $b;
    case 10:
        echo "10" . $b;
    case 11:
        echo "11" . $b;
    case 12:
        echo "12" . $b;
    case 13:
        echo "13" . $b;
    case 14:
        echo "14" . $b;
    case 15:
        echo "15" . $b;
}