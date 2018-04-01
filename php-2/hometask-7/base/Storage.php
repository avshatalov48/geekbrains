<?php
// Хранилище наших компонентов
namespace app\base;

class Storage
{
    protected $items = [];

    // Установка компонента
    public function set($object, $key)
    {
        $this->items[$key] = $object;
    }

    // Получение компонента. Отложенная инициализация.
    public function get($key)
    {
        // Существует ли такой компонент?
        if (!isset($this->items[$key])) {
            // Если нет - создаем компонент
            $this->items[$key] = App::call()->createComponent($key);
        }
        // Возвращаем компонент
        return $this->items[$key];
    }
}