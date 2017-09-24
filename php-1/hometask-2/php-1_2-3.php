<?php

/*3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
Обязательно использовать оператор return.*/

$a = rand(1,10);
$b = rand(1,10);
$c = "<br>";

echo "a = $a<br>b = $b<hr>";

function addition($a, $b) {
    return $a + $b;
}

function subtraction($a, $b) {
    return $a - $b;
}

function multiplication($a, $b) {
    return $a * $b;
}

function division($a, $b) {
    return $a / $b;
}

echo "a + b = $a + $b = " . addition($a, $b) . $c;
echo "a - b = $a - $b = " . subtraction($a, $b) . $c;
echo "a * b = $a * $b = " . multiplication($a, $b) . $c;
echo "a / b = $a / $b = " . division($a, $b) . $c;