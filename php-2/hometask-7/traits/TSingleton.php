<?php

namespace app\traits;


trait TSingleton
{
    private static $instance = null;

    // Защищаем от создания через "new"
    private function __construct()
    {
    }

    // Защищаем от создания через клонирование
    private function __clone()
    {
    }

    // Защищаем от создания через unserialize
    private function __wakeup()
    {
    }

    // Возвращает единственный экземпляр класса
    public static function getInstance()
    {
        // "self" меняем на "static" - тот класс, который реально будет вызывать этот код
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}