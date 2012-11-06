<?php

require __DIR__.'/../vendor/autoload.php';

use Igorw\Painblog\ConfigLoader;
use Igorw\Painblog\Storage\JsonStorage;
use Igorw\Painblog\Storage\PostRepository;
use Igorw\Painblog\View;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);

$jsonStorage = JsonStorage::create($configLoader->load('database'));
$postRepository = new PostRepository($jsonStorage);

$view = View::create($configLoader->load('view'));
