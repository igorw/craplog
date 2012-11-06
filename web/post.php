<?php

require __DIR__.'/bootstrap.php';

$id = (string) $_GET['id'];
$post = $postRepository->find($id);

$view->display('post', ['post' => $post]);
