<?php

namespace app\services;

use app\base\App;

class AutoloaderNotMatchException extends \Exception
{
}

class Autoloader
{
    private $fileExtension = ".php";

    function loadClass($className)
    {
        $className = str_replace("app\\", App::call()->config['root_dir'], $className);
        $className = str_replace("\\", "/", $className) . $this->fileExtension;
        if (file_exists($className)) {
            include $className;
        } else {
            throw new AutoloaderNotMatchException("Файл с классом не найден!");
        }
    }
}