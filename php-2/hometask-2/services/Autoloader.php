<?php

namespace app\services;

class Autoloader
{
    public $root = "app\\";

    function loadClass($className)
    {
//        var_dump($className);
        $filename = '..\\' . $className . '.php';
        $filename = str_replace($this->root, "", $filename);

        if (file_exists($filename)) {
            require_once($filename);
        }
    }
}