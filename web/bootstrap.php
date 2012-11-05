<?php

require __DIR__.'/../vendor/autoload.php';

use Doctrine\CouchDB\CouchDBClient;
use Igorw\Painblog\ConfigLoader;
use Igorw\Painblog\PostRepository;

$configLoader = new ConfigLoader(__DIR__.'/../config');
$couchClient = CouchDBClient::create($configLoader->load('database'));
$postRepository = new PostRepository($couchClient);
