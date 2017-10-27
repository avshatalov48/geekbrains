<?php

namespace app\services;

class Autoloader
{
    public $root = "app\\";

    function loadClass($className)
    {
//        var_dump($className);
        $className = str_replace($this->root, "", $className);
        $filename = '..\\' . $className . '.php';

        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}