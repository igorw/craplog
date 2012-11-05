<?php

namespace Igorw\Painblog;

class ConfigLoader
{
    private $basePath;

    public function __construct($basePath)
    {
        $this->basePath = $basePath;
    }

    public function load($filename)
    {
        $json = file_get_contents($this->basePath.'/'.$filename.'.json');
        return json_decode($json, true);
    }
}
