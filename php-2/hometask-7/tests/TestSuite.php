<?php
require_once 'AutoloaderTest.php';
require_once 'TemplateRendererTest.php';

class TestSuite extends PHPUnit_Framework_TestSuite
{
    public static function suite()
    {
        $suite = new TestSuite('Tests');
        $suite->addTestSuite('AutoloaderTest');
        $suite->addTestSuite('TemplateRendererTest');
        return $suite;
    }
}