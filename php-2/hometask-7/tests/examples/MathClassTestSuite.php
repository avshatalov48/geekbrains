<?php
require_once 'MathClassTest.php';
require_once 'MathClassProviderTest.php';

// Наборы тестов реализованы классом PHPUnit_Framework_TestSuite
class MySuite extends PHPUnit_Framework_TestSuite
{
    protected $sharedFixture;

    public static function suite()
    {
        $suite = new MySuite ('MyTestSuite');
        $suite->addTestSuite('MathClassTest');
        $suite->addTestSuite('MathClassProviderTest');
        return $suite;
    }

    // Метод setUp() выполняется перед тестом. То есть, используя данный метод можно выполнить различные подготовительные действия.
    protected function setUp()
    {
        $this->sharedFixture = new MathClass();
    }

    // Метод tearDown() ыполняется после теста. То есть можно удалить лишние данные.
    protected function tearDown()
    {
        $this->sharedFixture = NULL;
    }
}