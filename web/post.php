<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepo->find($id);

echo $view->render('post', [
    'post'          => $post,
    'user'          => $user,
    'csrfToken'     => $csrfChecker->createToken(),
    'authorizer'    => $authorizer,
]);
