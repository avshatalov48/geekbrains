<?php
require_once 'AutoloaderTest.php';

class TestSuite extends PHPUnit_Framework_TestSuite
{
    protected $sharedFixture;

    public static function suite()
    {
        $suite = new TestSuite('Tests');
        $suite->addTestSuite('AutoloaderTest');
        return $suite;
    }
}