<?php

require __DIR__.'/bootstrap.php';

$name = null;
$password = null;

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $password = $_POST['password'];

    if ($authenticator->authenticate($name, $password)) {
        $user = $userRepo->findByName($name);
        $session->set('user', $user);
        header('Location: index.php');
        return;
    }
}

echo $view->render('login', [
    'user'      => $user,
    'name'      => $name,
    'password'  => $password,
]);
