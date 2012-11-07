<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepo->find($id);

if (!$user) {
    header('Location: login.php');
    return;
}

$authorizer->ensureHasRole($user, 'admin');

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $csrfChecker->ensureIsValid($_POST['csrfToken']);

    $newPost = array_merge($post, array(
        'title' => $_POST['title'],
        'body'  => $_POST['body'],
    ));
    $postPersister->update($post, $newPost);

    header('Location: post.php?id='.$id);
    return;
}

echo $view->render('edit', [
    'post'          => $post,
    'csrfToken'     => $csrfChecker->createToken(),
]);
