<?php

namespace services;

class Autoloader
{
    function loadClass($className)
    {
        var_dump($className);
        $filename = '..\\' . $className . '.php';
        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}