<?php

namespace app\services;

// Создаем свой Exception - чтобы отлавливать именно его, а не другие
class RequestNotMatchException extends \Exception{}

class Request
{
    // Строка запроса
    private $requestString;
    // Параметры
    private $params;

    private $controllerName;
    private $actionName;

    // Паттерн со структурой запроса
    // \w+  один или больше alphanumeric-символов, то же, что и [a-zA-Z0-9]+
    // i - не различать строчные и заглавные буквы.
    // P<controller> - placeholder, извлекает и сразу записывает в ключ controller
    private $patterns = [
        "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui"
    ];

    public function __construct()
    {
        // Получаем строку запроса из суперглобального массива
        // $_GET нам не поможет, потому, как параметры не передаем

        $this->requestString = $_SERVER['REQUEST_URI'];
        // Запускаем парсинг при каждом создании нового объекта
        $this->parseRequest();
    }

    // Парсинг запроса
    private function parseRequest()
    {
        foreach ($this->patterns as $pattern){
            // preg_match_all - Выполняет глобальный поиск шаблона в строке
            if(preg_match_all($pattern, $this->requestString, $matches)){
                $this->controllerName = $matches['controller'][0];
                $this->actionName = $matches['action'][0];
                // параметры считываем напрямую
                // $_REQUEST - Переменные HTTP-запроса
                $this->params = $_REQUEST;
                /*foreach (explode("&", $matches['params'][0]) as $param){
                    $p = explode("=",$param);
                    $this->params[$p[0]] = $p[1];
                }     */
                return;
            }
            // https://php.ru/manual/language.exceptions.html
            throw new RequestNotMatchException("Неправильный запрос!");
        }

    }

    // Какой Controller запустить
    public function getControllerName()
    {
        return $this->controllerName;
    }

    // Какой Action вызвать
    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }
}