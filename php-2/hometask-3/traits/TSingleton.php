<?php

namespace app\traits;

trait TSingleton
{
    private static $instance = null;

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    /**
     * @return static
     */
    public static function getInstance(){
        if(is_null(static::$instance)){
            static::$instance = new static();
        }
        return static::$instance;
    }
}