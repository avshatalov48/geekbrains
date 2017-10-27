<?php

include "../services/Autoloader.php";

spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);

//public function __construct($article, $category, $title, $description, $size, $weight, $price, $guarantee, $country, $count)

/*Товар на вес*/
$productWeight = new \app\models\Product_Weight(942156, "Наполнители", "Наполнитель впитывающий Fresh Step Тройная защита",
    "Fresh Step Extreme - уникальный впитывающий наполнитель с тройной защитой, который позволяет эффективно преодолеть неприятный запах и надежно впитывает влагу.",
    null, null, 114.5, null, "США", "10");

echo "Покупка 1 (5 кг): {$productWeight->getPrice(5)} руб.<br>";
echo "Покупка 2 (4.52 кг): {$productWeight->getPrice(4.52)} руб.<br>";
echo "Доход с продаж: {$productWeight->getTotal()} руб.<br>";
var_dump($productWeight);


/*Штучный товар*/
$productReal = new \app\models\Product_Real(137538198, "Книги", "Дмитрий Котеров, Игорь Симдянов | PHP 7 (Твердый переплет)",
    "Рассмотрены основы языка PHP и его рабочего окружения в Windows, Mac OS X и Linux. Отражены радикальные изменения в языке PHP, произошедшие с момента выхода предыдущего издания: трейты, пространство имен, анонимные функции, замыкания, элементы строгой типизации, генераторы, встроенный Web-сервер и многие другие возможности.",
    "170x240", "1115", 969, null, "Россия", "7");

echo "Покупка 1 (1 шт): {$productReal->getPrice(1)} руб.<br>";
echo "Покупка 2 (2 шт): {$productReal->getPrice(2)} руб.<br>";
echo "Доход с продаж: {$productReal->getTotal()} руб.<br>";
var_dump($productReal);


/*Цифровой товар*/
$productDigital = new \app\models\Product_Digital(137538198, "Книги", "Дмитрий Котеров, Игорь Симдянов | PHP 7 (Цифровая книга)",
    "Рассмотрены основы языка PHP и его рабочего окружения в Windows, Mac OS X и Linux. Отражены радикальные изменения в языке PHP, произошедшие с момента выхода предыдущего издания: трейты, пространство имен, анонимные функции, замыкания, элементы строгой типизации, генераторы, встроенный Web-сервер и многие другие возможности.",
    null, null, 969, null, "Россия", null);

echo "Покупка 1 (1 шт): {$productDigital->getPrice(1)} руб.<br>";
echo "Покупка 2 (2 шт): {$productDigital->getPrice(2)} руб.<br>";
echo "Доход с продаж: {$productDigital->getTotal()} руб.<br>";
var_dump($productDigital);


function sum($products)
{
    $sum = 0;
    foreach ($products as $product) {
        $sum += $product->getTotal();
    }
    return $sum;
}

echo "<hr>Доход со всех продаж составил: " . sum([$productWeight, $productReal, $productDigital]) . " руб.";