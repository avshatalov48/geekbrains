<?php

/*2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора
switch организовать вывод чисел от $a до 15.*/

$a = rand(0,15);

echo "a = $a<br>";

switch ($a) {
    case ($a>=15):
        echo "15<br>";
    case ($a>=14):
        echo "14<br>";
    case ($a>=13):
        echo "13<br>";
    case ($a>=12):
        echo "12<br>";
    case ($a>=11):
        echo "11<br>";
    case ($a>=10):
        echo "10<br>";
    case ($a>=9):
        echo "9<br>";
    case ($a>=8):
        echo "8<br>";
    case ($a>=7):
        echo "7<br>";
    case ($a>=6):
        echo "6<br>";
    case ($a>=5):
        echo "5<br>";
    case ($a>=4):
        echo "4<br>";
    case ($a>=3):
        echo "3<br>";
    case ($a>=2):
        echo "2<br>";
    case ($a>=1):
        echo "1<br>";
    default:
        echo "0<br>";
}