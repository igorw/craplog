<?php

namespace Igorw\Painblog;

use Doctrine\CouchDB\CouchDBClient;
use Doctrine\CouchDB\HTTP\Response;

class PostRepository
{
    private $couchClient;

    public function __construct(CouchDBClient $couchClient)
    {
        $this->couchClient = $couchClient;
    }

    public function findAll()
    {
        $response = $this->couchClient->allDocs();
        $this->checkResponseValid($response);
    }

    private function checkResponseValid(Response $response)
    {
        if (200 !== $response->status) {
            throw new \RuntimeException(json_encode($response));
        }
    }
}
