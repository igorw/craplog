<?php

namespace Igorw\Painblog;

use Doctrine\CouchDB\CouchDBClient;

class PostPersister
{
    private $couchClient;

    public function __construct(CouchDBClient $couchClient)
    {
        $this->couchClient = $couchClient;
    }

    public function save(array $post)
    {
    }
}
