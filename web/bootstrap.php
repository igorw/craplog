<?php

require __DIR__.'/../vendor/autoload.php';

use Evenement\EventEmitter;
use Igorw\Craplog\ConfigLoader;
use Igorw\Craplog\Security\Authorizer;
use Igorw\Craplog\Security\PlaintextAuthenticator;
use Igorw\Craplog\Security\SessionCsrfChecker;
use Igorw\Craplog\Session;
use Igorw\Craplog\Storage\JsonStorage;
use Igorw\Craplog\Storage\PostPersister;
use Igorw\Craplog\Storage\PostRepository;
use Igorw\Craplog\Storage\UserRepository;
use Igorw\Craplog\View;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);
$dbConfig = $configLoader->load('database');

$postStorage = new JsonStorage($dbConfig['posts']);
$postRepo = new PostRepository($postStorage);
$postPersister = new PostPersister($postStorage);

$userStorage = new JsonStorage($dbConfig['users']);
$userRepo = new UserRepository($userStorage);
$authenticator = new PlaintextAuthenticator($userRepo);
$authorizer = new Authorizer();

$view = View::create($configLoader->load('view'));

$session = new Session();
$session->init();
$user = $session->get('user');

$csrfChecker = new SessionCsrfChecker($session);

$emitter = new EventEmitter();

$pluginClasses = $configLoader->load('plugins');
foreach ($pluginClasses as $pluginClass) {
    $plugin = new $pluginClass();
    $plugin->attachEvents($emitter);
}
