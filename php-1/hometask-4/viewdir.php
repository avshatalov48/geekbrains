<?php
/**
 * 1. Написать функцию, отображающую все дерево файлов и каталогов,
 * начиная от указанной директории.
 */

// viewdir.php?dir=..\..\

define("PUBLIC_DIR", ".");
$dir = $_GET['dir'];
if (!$dir) $dir = PUBLIC_DIR;

function spaces($path)
{
    $count = substr_count($path, "/") - 1;
    $space = str_repeat("&nbsp; &nbsp; ", $count);
    return $space;
}

function render($directory, $filename)
{
    if ($filename == "." || $filename == "..") {
        return;
    }
    $path = $directory . "/" . $filename;
    if (is_dir($path)) {
        $type = "[DIR] ";
    } else {
        $type = "<small>";
        $fileInfo = " [" . date("d.m.Y H:i", filemtime($path)) . "] [" . filesize($path) . " байт] [" . substr(sprintf('%o', fileperms($path)), -4) . "]</small>";
    }
    echo spaces($path) . "{$type}{$filename}{$fileInfo}<br>";
}

// Old PHP version (opendir)
function viewDir($directory = PUBLIC_DIR)
{
    $dir = opendir($directory);
    while ($filename = readdir($dir)) {
        $path = $directory . "/" . $filename;
        render($directory, $filename);
        if (is_dir($path) && $filename != "." && $filename != "..") {
            viewDir($path);
        }
    }
    closedir($dir);
}

// PHP 5, 7 (scandir)
function viewDir57($directory = PUBLIC_DIR)
{
    $dir = scandir($directory, 0);
    foreach ($dir as $filename) {
        $path = $directory . "/" . $filename;
        render($directory, $filename);
        if (is_dir($path) && $filename != "." && $filename != "..") {
            viewDir57($path);
        }
    }
}

viewDir($dir);
echo "<hr>";
viewDir57($dir);