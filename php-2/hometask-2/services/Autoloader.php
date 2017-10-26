<?php
//namespace services;

class Autoloader
{
    private $paths = [
        'models/'
    ];

    function loadClass($className)
    {
        foreach ($this->paths as $path) {
            $filename = "../{$path}{$className}.php";
            if (file_exists($filename)) {
                require($filename);
                break;
            }
        }
    }
}