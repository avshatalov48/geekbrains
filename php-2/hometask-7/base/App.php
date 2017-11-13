<?php
//  Данный класс - наше приложение
namespace app\base;
// Т.к. автолоадер подключаем после Singleton, поэтому Singleton подключаем вручную через include
include "../traits/TSingleton.php";

use app\controllers\Controller;
use app\services\Db;
use app\services\Request;
use app\traits\TSingleton;

class ComponentNotFoundException extends \Exception
{
}

class App
{
    use TSingleton;

    // Свойство-массив со всеми параметрами config
    public $config;
    // Будем в нем хранить компоненты, с отложенной инициализацией
    public $components;

    // Переопределим getInstance() на call() для удобства
    public static function call()
    {
        return static::getInstance();
    }

    // Запуск приложения
    public function run()
    {
        $this->config = include "../config/main.php";
        $this->autoloadRegister();
        $this->components = new Storage();
        // Стартуем FrontController
        $this->mainController->runAction();
    }

    // Наши автозагрузчики из старого index.php
    private function autoloadRegister()
    {
        include "../services/Autoloader.php";
        include "../vendor/autoload.php";
        spl_autoload_register([new \app\services\Autoloader(), 'loadClass']);
    }

    // Используем магический метод __get, который будет вызываться при обращении к свойству, которого нет в нашем массиве components конфига
    function __get($name)
    {
        return $this->components->get($name);
    }

    // Создание компонента (имя компонента)
    function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            //
            $params = $this->config['components'][$name];
            // Получаем имя класса компонента из $params
            $className = $params['class'];
            // Существует ли такой класс?
            if (class_exists($className)) {
                // Убираем из параметров Class, т.к. в конструкторе в параметрах никакого класса быть не может!
                unset($params['class']);
                $reflection = new \ReflectionClass($className);
                // ReflectionClass::newInstanceArgs - Создаёт экземпляр класса с переданными параметрами
                return $reflection->newInstanceArgs($params);
            }
        }
        // Исключение - Компонент не найден
        throw new ComponentNotFoundException($name);
    }

}