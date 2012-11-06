<?php

namespace Igorw\Painblog;

class View
{
    private $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($name, $vars = array())
    {
        ob_start();
        $this->display($name, $vars);
        return ob_get_clean();
    }

    public function display($name, $vars = array())
    {
        extract($vars);
        include $this->basePath.'/'.$name.'.php';
    }

    public function escape($value)
    {
        return htmlspecialchars($value);
    }

    public static function create($options)
    {
        return new static($options['view.path']);
    }
}
