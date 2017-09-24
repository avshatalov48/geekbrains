<?php

/*4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где
$arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от
переданного значения операции выполнить одну из арифметических операций (использовать
функции из пункта 3) и вернуть полученное значение (использовать switch).*/

$arg1 = rand(0,9);
$arg2 = rand(0,9);
$operations = array("+", "-", "*", "/");
$operation = $operations[rand(0,3)];

echo "arg1 = $arg1<br>arg2 = $arg2<br>operation = $operation<hr>";

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

function mathOperation($arg1, $arg2, $operation) {
    switch ($operation) {
        case "+":
            return addition($arg1, $arg2);
        case "-":
            return subtraction($arg1, $arg2);
        case "*":
            return multiplication($arg1, $arg2);
        case "/":
            return division($arg1, $arg2);
    }
}

echo "arg1 $operation arg2 = $arg1 $operation $arg2 = " . mathOperation($arg1, $arg2, $operation);