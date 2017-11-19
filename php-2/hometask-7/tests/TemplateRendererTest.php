<?php

define("PREFIX", "..");

require_once PREFIX . '/services/renderers/IRenderer.php';
require_once PREFIX . '/services/renderers/TemplateRenderer.php';
require_once PREFIX . "/base/App.php";

use app\services\renderers\TemplateRenderer;
use app\base\App;

class TemplateRendererTest extends PHPUnit_Framework_TestCase
{
    protected $sharedFixture;

    /**
     * @dataProvider providerRender
     */

    public function testRender($template, $params, $content)
    {
        $this->assertContains($content, $this->sharedFixture->render($template, $params));
    }

    public function providerRender()
    {
        return array(
            array("card", [], "<br>"),
            array("login", [], "</form>")
        );
    }

    protected function setUp()
    {
        App::call()->config['root_dir'] = PREFIX;
        $this->sharedFixture = new TemplateRenderer();
    }

    protected function tearDown()
    {
        $this->sharedFixture = NULL;
    }
}