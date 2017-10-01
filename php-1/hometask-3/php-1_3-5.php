<?php
header("Content-type:text/html; charset=utf-8");

/*
 * 5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.
 *
 * Функцию strtr() использовать запрещено!
 */

$string = "<p>1.&nbsp;Чтобы показать заказчику эскизы, нужно где-то найти тексты и картинки. Как правило, ни того, ни другого в момент показа эскизов у дизайнера нету.</p><p>2.&nbsp;Что же делает дизайнер? Рыбу. Рыбу можно вставлять, использовать, вешать, заливать, показывать, запихивать... Словом, с ней делают что угодно, лишь бы эскиз был максимально похож на готовую работу.</p><p>3.&nbsp;Если в качестве рыбных картинок использовать цветные прямоугольники, а вместо текста — несколько повторяющихся слов, эскиз будет выглядеть неестественно.</p>";

function underline($string)
{
    $dictionary = [
        " " => "_"
    ];

    // Преобразование строки в массив. Решение проблемы с UTF-8
    // https://stackoverflow.com/questions/21653033/php-how-to-split-a-utf-8-string
    $stringToArray = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($stringToArray as $key => $character) {
        foreach ($dictionary as $symbol => $sign) {
            if ($character == $symbol) {
                $stringToArray[$key] = $sign;
                break;
            }
        }
    }

    // implode — Объединяет элементы массива в строку
    return implode($stringToArray);
}

echo "<b>Исходная строка:</b> $string <hr>";
echo "<b>Преобразованная:</b>" . underline($string);