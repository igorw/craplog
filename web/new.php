<?php

require __DIR__.'/bootstrap.php';

if (!$user) {
    header('Location: login.php');
    return;
}

$authorizer->ensureHasRole($user, 'admin');

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $csrfChecker->ensureIsValid($_POST['csrfToken']);

    $post = array(
        'id'    => $_POST['id'],
        'title' => $_POST['title'],
        'date'  => date('Y-m-d', $_SERVER['REQUEST_TIME']),
        'body'  => $_POST['body'],
    );
    $postPersister->save($post);

    header('Location: post.php?id='.$post['id']);
    return;
}

echo $view->render('new', [
    'user'          => $user,
    'csrfToken'     => $csrfChecker->createToken(),
    'authorizer'    => $authorizer,
]);
