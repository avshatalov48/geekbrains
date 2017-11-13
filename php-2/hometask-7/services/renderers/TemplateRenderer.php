<?php

namespace app\services\renderers;

use app\base\App;

class TemplateRenderer implements IRenderer
{
    public function render($template, $params)
    {
        extract($params);
        ob_start();
        $templatePath = App::call()->config['root_dir'] . "/views/{$template}.php";
        include $templatePath;
        return ob_get_clean();
    }
}