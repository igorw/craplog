<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepo->find($id);

if (!$user) {
    header('Location: login.php');
    return;
}

$authorizer->ensureHasRole($user, 'admin');

if ('POST' !== $_SERVER['REQUEST_METHOD']) {
    header('Location: index.php');
    return;
}

$csrfChecker->ensureIsValid($_POST['csrfToken']);

$postPersister->delete($post);

header('Location: index.php');
