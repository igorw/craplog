<?php

require __DIR__.'/bootstrap.php';

$posts = $postRepository->findAll();

echo $view->render('index', ['posts' => $posts]);
