<?php
namespace app\services;

class AutoloaderNotMatchException extends \Exception{}

class Autoloader
{
    private $fileExtension = ".php";

    function loadClass($className)
    {
        $className = str_replace("app\\", ROOT_DIR, $className);
        $className = str_replace("\\", "/", $className) . $this->fileExtension;
        if (file_exists($className)) {
            include $className;
        } else {
            throw new AutoloaderNotMatchException("Файл с классом не найден!");
        }
    }
}