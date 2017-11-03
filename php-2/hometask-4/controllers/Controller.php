<?php

namespace app\controllers;

abstract class Controller
{
    // Текущий action, который выполняем
    private $action;
    // action по умолчанию
    private $defaultAction = "index";
    // Наименование шаблона
    private $layout = "main";
    // Используем при рендеринге layout или нет
    protected $useLayout = true;

    // Формируем правильное имя action и запускаем его
    public function run($action = null)
    {
        // если action пустой, то запускается action по default
        $this->action = $action ?: $this->defaultAction;
        // Преобразование card-my-test-privet => actionCardMyTestPrivet
        // ucwords — Преобразует в верхний регистр первый символ каждого слова в строке
        $action = ucwords(str_replace("-", " ", $action));
        $action = "action" . str_replace(" ", "", $action);
        $this->$action();
    }

    // Для передачи объекта во View - Имя шаблона и параметры
    // Подготовка, формирование шаблона - чистый вид шаблона или еще оборачиваем в Layout
    public function render($template, $params)
    {
        if($this->useLayout){
            return $this->renderTemplate("layouts/{$this->layout}",
                ['content' => $this->renderTemplate($template, $params)]
            );
        }else{
            return $this->renderTemplate($template, $params);
        }
    }

    // Метод отображения шаблона
    public function renderTemplate($template, $params)
    {
        // Получаем из массива переменные
        // extract — Импортирует переменные из массива в текущую таблицу символов. Каждый ключ проверяется на предмет корректного имени переменной. Также проверяются совпадения с существующими переменными в символьной таблице.
        extract($params);
        // ob_start — Включение буферизации вывода. Идет не на вывод, а в память.
        ob_start();
        // Формируем путь до шаблона
        $templatePath = ROOT_DIR . "/views/{$template}.php";
        // include сразу отправляет в выходной поток, поэтому используем буферизацию вывода
        include $templatePath;
        // ob_get_clean — Получить содержимое текущего буфера и удалить его.
        // По завершении скрипта, буфер все равно освобождается!
        return ob_get_clean();
    }
}