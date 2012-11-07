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
use Igorw\Craplog\Storage\PostNotFoundException;
use Igorw\Craplog\Storage\UserRepository;
use Igorw\Craplog\View;

$debug = true;

$configLoader = new ConfigLoader(__DIR__.'/../config', ['root_path' => __DIR__.'/..']);
$dbConfig = $configLoader->load('database');

$postStorage = new JsonStorage($dbConfig['posts']);
$postRepo = new PostRepository($postStorage);
$postPersister = new PostPersister($postStorage);

$userStorage = new JsonStorage($dbConfig['users']);
$userRepo = new UserRepository($userStorage);
$authenticator = new PlaintextAuthenticator($userRepo);
$authorizer = new Authorizer();

$emitter = new EventEmitter();

$session = new Session();
$session->init();
$user = $session->get('user');

$globals = [
    'authorizer'    => $authorizer,
    'emitter'       => $emitter,
    'user'          => $user,
];
$view = View::create($configLoader->load('view'), $globals);

$csrfChecker = new SessionCsrfChecker($session);

$pluginClasses = $configLoader->load('plugins');
foreach ($pluginClasses as $pluginClass) {
    $plugin = new $pluginClass();
    $plugin->attachEvents($emitter);
}

set_exception_handler(function ($e) use ($view, $debug) {
    if ($e instanceof PostNotFoundException) {
        header('HTTP/1.1 404 Not Found');
        $error = 'The post you wanted could not be found.';
        $view->display('error', ['error' => $error]);
        return;
    }

    if ($debug) {
        throw $e;
    }

    header('HTTP/1.1 500 Internal Server Error');
    $error = $e->getMessage() ?: 'We had an error of type: '.get_class($e).'.';
    $view->display('error', ['error' => $error]);
});
