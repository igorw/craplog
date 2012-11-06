<?php

require __DIR__.'/bootstrap.php';

$posts = $postRepository->findAll();

$view->display('index', ['posts' => $posts]);
