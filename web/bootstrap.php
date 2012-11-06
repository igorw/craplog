<?php

require __DIR__.'/../vendor/autoload.php';

use Igorw\Painblog\ConfigLoader;
use Igorw\Painblog\Storage\JsonStorage;
use Igorw\Painblog\Storage\PostRepository;
use Igorw\Painblog\Storage\UserRepository;
use Igorw\Painblog\Security\PlaintextAuthenticator;
use Igorw\Painblog\Security\Authorizer;
use Igorw\Painblog\View;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);
$dbConfig = $configLoader->load('database');

$postStorage = new JsonStorage($dbConfig['posts']);
$postRepo = new PostRepository($postStorage);

$userStorage = new JsonStorage($dbConfig['users']);
$userRepo = new UserRepository($userStorage);
$authenticator = new PlaintextAuthenticator($userRepo);
$authorizer = new Authorizer();

if (isset($_COOKIE[session_name()])) {
    session_start();
}
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

$view = View::create($configLoader->load('view'));
