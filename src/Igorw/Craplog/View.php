<?php

namespace Igorw\Craplog;

class View
{
    private $basePath;
    private $globals;
    private $layout;
    private $blocks = [];
    private $blockData = [];

    public function __construct($basePath, $globals = [])
    {
        $this->basePath = $basePath;
        $this->globals = $globals;
    }

    public function render($name, $vars = [])
    {
        ob_start();
        $this->display($name, $vars);
        $data = ob_get_clean();
        return ltrim($data);
    }

    public function display($name, $vars = [])
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

    private function displayView($_name, $_vars)
    {
        $_vars = array_merge($this->globals, $_vars);
        extract($_vars);
        include $this->basePath.'/'.$_name.'.php';
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

    public static function create($options, array $globals = [])
    {
        return new static($options['view.path'], $globals);
    }
}
