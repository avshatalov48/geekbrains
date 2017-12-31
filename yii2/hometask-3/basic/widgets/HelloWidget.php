<?php

namespace app\widgets;

use yii\base\Widget;

class HelloWidget extends Widget
{
    public $message = "Нажми меня";

//    Запускается при инициализации
//    public function init()
//    {
//        return $this;
//    }

    // Вызывается при запуске widget или end
    public function run()
    {
        return $this->render("hello", ['message' => $this->message]);
    }
}