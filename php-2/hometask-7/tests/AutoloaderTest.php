<?php

define("PREFIX", "../");

require_once PREFIX . "base/App.php";
require_once PREFIX . 'services/Autoloader.php';
require_once PREFIX . 'controllers/Controller.php';

use app\services\Autoloader;

class AutoloaderTest extends PHPUnit_Framework_TestCase
{
    protected $sharedFixture;

    /**
     * @dataProvider providerLoadClass
     */

    public function testLoadClass($className)
    {
        $this->assertNull($this->sharedFixture->loadClass($className));
    }

    public function providerLoadClass()
    {
        return array(
            array(PREFIX . "app\services\Auth"),
            array(PREFIX . "app\services\Db"),
            array(PREFIX . "app\services\Request"),
            array(PREFIX . "app\controllers\AuthController"),
            array(PREFIX . "app\controllers\FrontController"),
            array(PREFIX . "app\controllers\ProductController")
        );
    }

    protected function setUp()
    {
        $this->sharedFixture = new Autoloader();
    }

    protected function tearDown()
    {
        $this->sharedFixture = NULL;
    }
}