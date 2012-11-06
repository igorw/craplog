<?php

namespace Igorw\Painblog;

class View
{
    private $basePath;
    private $layout;
    private $blocks = [];
    private $blockData = [];

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($name, $vars = array())
    {
        ob_start();
        $this->display($name, $vars);
        $data = ob_get_clean();
        return ltrim($data);
    }

    public function display($name, $vars = array())
    {
        $this->displayView($name, $vars);

        if ($this->layout) {
            $this->displayLayout($vars);
        }
    }

    private function displayLayout($vars)
    {
        $this->displayView($this->layout, $vars);
    }

    private function displayView($name, $vars)
    {
        extract($vars);
        include $this->basePath.'/'.$name.'.php';
    }

    public function layout($name)
    {
        $this->layout = $name;
    }

    public function block($name)
    {
        $this->blocks[] = $name;
        ob_start();
    }

    public function end()
    {
        $name = array_pop($this->blocks);
        $data = ob_get_clean();

        $this->blockData[$name] = $data;
    }

    public function getBlock($name)
    {
        return $this->blockData[$name];
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
