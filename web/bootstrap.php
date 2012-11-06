<?php

require __DIR__.'/../vendor/autoload.php';

use Igorw\Painblog\ConfigLoader;
use Igorw\Painblog\Storage\JsonStorage;
use Igorw\Painblog\Storage\PostRepository;
use Igorw\Painblog\Security\PlaintextAuthenticator;
use Igorw\Painblog\Security\Authorizer;
use Igorw\Painblog\View;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);
$dbConfig = $configLoader->load('database');

$postStorage = new JsonStorage($dbConfig['posts']);
$postRepository = new PostRepository($postStorage);

$userStorage = new JsonStorage($dbConfig['users']);
$authenticator = new PlaintextAuthenticator($userStorage);
$authorizer = new Authorizer();

$view = View::create($configLoader->load('view'));
