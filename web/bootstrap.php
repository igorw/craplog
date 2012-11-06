<?php

require __DIR__.'/../vendor/autoload.php';

use Igorw\Painblog\ConfigLoader;
use Igorw\Painblog\Security\PlaintextAuthenticator;
use Igorw\Painblog\Security\Authorizer;
use Igorw\Painblog\Session;
use Igorw\Painblog\Storage\JsonStorage;
use Igorw\Painblog\Storage\PostRepository;
use Igorw\Painblog\Storage\UserRepository;
use Igorw\Painblog\View;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);
$dbConfig = $configLoader->load('database');

$postStorage = new JsonStorage($dbConfig['posts']);
$postRepo = new PostRepository($postStorage);

$userStorage = new JsonStorage($dbConfig['users']);
$userRepo = new UserRepository($userStorage);
$authenticator = new PlaintextAuthenticator($userRepo);
$authorizer = new Authorizer();

$view = View::create($configLoader->load('view'));

$session = new Session();
$session->init();
$user = $session->get('user');
