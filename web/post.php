<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepository->find($id);

echo $view->render('post', ['post' => $post]);
