<?php

namespace app\controllers;

use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer;

class ActionNotMatchException extends \Exception
{
}

abstract class Controller
{
    private $action;
    private $defaultAction = "index";
    private $layout = "main";
    protected $useLayout = true;

    /** @var TemplateRenderer */
    private $renderer = null;

    /**
     * Controller constructor.
     * @param null $renderer
     */
    public function __construct(IRenderer $renderer = null)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $action = "action" . ucfirst($this->action);
        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            throw new ActionNotMatchException("Action не найден!");
        }
    }

    public function render($template, $params, $layoutParams = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout},$layoutParams",
                ['content' => $this->renderTemplate($template, $params)]
            );
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params)
    {
        return $this->renderer->render($template, $params);
    }
}