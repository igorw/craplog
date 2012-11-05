<?php

require __DIR__.'/../vendor/autoload.php';

use Doctrine\CouchDB\CouchDBClient;
use Igorw\Painblog\ConfigLoader;

$configLoader = new ConfigLoader(__DIR__.'/../config');
$couchClient = CouchDBClient::create($configLoader->load('database'));
