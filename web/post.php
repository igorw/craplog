<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepo->find($id);

echo $view->render('post', [
    'post'          => $post,
    'csrfToken'     => $csrfChecker->createToken(),
]);
