<?php

namespace app\services;

class Autoloader
{
    private $fileExtension = ".php";

    function loadClass($className)
    {
        $className = str_replace("app\\", ROOT_DIR, $className);
        $className = str_replace("\\", "/", $className) . $this->fileExtension;
        include $className;
    }
}