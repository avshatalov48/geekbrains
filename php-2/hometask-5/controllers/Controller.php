<?php
namespace app\controllers;

use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer;

abstract class Controller {
    private $templateEngine = "study";
    private $action;
    private $defaultAction = "index";
    private $layout = "main";
    protected $useLayout = true;

    /** @var TemplateRenderer  */
    private $renderer = null;

    /**
     * Controller constructor.
     * @param null $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $action = "action" . ucfirst($this->action);
        $this->$action();
    }

    public function render($template, $params)
    {
        $template = $this->templateEngine . "/" . $template;
        if($this->useLayout){
            $layout = $this->templateEngine . "/" . "layouts/" . $this->layout;
            return $this->renderTemplate($layout,
                ['content' => $this->renderTemplate($template, $params)]
            );
        }else{
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params)
    {
        return $this->renderer->render($template, $params);
    }
}