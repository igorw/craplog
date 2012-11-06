<?php

namespace Igorw\Painblog\Storage;

class JsonStorage
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function load()
    {
        $json = file_get_contents($this->file);
        return json_decode($json, true);
    }

    public function store($data)
    {
        $json = json_encode($data);
        file_put_contents($this->file, $json);
    }
}
