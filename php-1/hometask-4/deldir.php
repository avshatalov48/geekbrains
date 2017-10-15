<?php
header("Content-type:text/html; charset=utf-8");
/**
 * 2. Написать функцию, удаляющую указанную папку (с ее полным очищением).
 */

// deldir.php?dir=examples&del=true

define("PUBLIC_DIR", ".");
$dir = $_GET['dir'];
$del = $_GET['del'];
if (!$dir) $dir = PUBLIC_DIR;

function render($result, $path)
{
    if (stristr(getenv('OS'), "win")) {
        $path = iconv("WINDOWS-1251", "UTF-8", $path);
    }
    echo $path;
    echo ($result) ? " - успешно удален! " : " - <b>ошибка при удалении!</b>";
    echo "<br>";
}

function delDir($directory = PUBLIC_DIR)
{
    static $level;
    $level++;
    // Проверка существования каталога
    if (!file_exists($directory)) {
        echo "$directory - <b>не существует!</b>";
        return;
    }
    $dir = scandir($directory, 0);
    foreach ($dir as $filename) {
        $path = $directory . "/" . $filename;
        if ($filename == "deldir.php") continue;
        if (is_dir($path) && $filename != "." && $filename != "..") {
            delDir($path);
            $level--;
            render(rmdir($path), $path);
        } elseif (is_file($path)) {
            render(unlink($path), $path);
        }
    }
    // Удаление последнего каталога через определение уровня вложенности рекурсии
    if (file_exists($directory) && $level == 1 && $directory != ".") {
        render(rmdir($directory), $directory);
    }
}

if ($del) {
    delDir($dir);
} else {
    echo "<b>Внимание! Данная функция удаляет указанную папку (с ее полным очищением).</b><br>";
    echo '$dir - путь к папке (по умолчанию - удаляет все, что ниже по дереву)<br>';
    echo '$del - ключ от случайного удаления<br>';
    echo 'Пример: deldir.php?dir=examples&del=true<br>';
}