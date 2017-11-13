<?php
namespace app\services;

use app\base\App;

class Autoloader
{
    private $fileExtension = ".php";

    function loadClass($className)
    {
        $className = str_replace("app\\", App::call()->config['root_dir'], $className);
        $className = str_replace("\\", "/", $className) . $this->fileExtension;
        include $className;
    }
}