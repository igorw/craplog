<?php

namespace Igorw\Craplog;

class ConfigLoader
{
    private $basePath;
    private $replacements;

    public function __construct($basePath, array $replacements)
    {
        $this->basePath = $basePath;
        $this->replacements = $replacements;
    }

    public function load($filename)
    {
        $json = file_get_contents($this->basePath.'/'.$filename.'.json');
        foreach ($this->replacements as $var => $replacement) {
            $json = str_replace("%$var%", $replacement, $json);
        }
        return json_decode($json, true);
    }
}
