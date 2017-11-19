<?php

require_once 'MathClass.php';

// Название класса в тесте формируется из названия тестируемого класса плюс «Test»;
// Класс для тестирования обычно наследуется от PHPUnit_Framework_TestCase;
class MathClassTest extends PHPUnit_Framework_TestCase
{
    // Любой тест имеет область видимости public, а его название начинается с префикса «test»;
    public function testFactorial()
    {
        $my = new MathClass ();
        // Внутри теста мы применяем один из assert-методов для выяснения соответствует ли результат обработки ожидаемому;
        $this->assertEquals(6, $my->factorial(3));
    }
}