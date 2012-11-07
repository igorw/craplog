<?php

require __DIR__.'/bootstrap.php';

$posts = $postRepo->findAll();

echo $view->render('index', [
    'posts'         => $posts,
]);
