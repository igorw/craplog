<?php

namespace Igorw\Painblog\Storage;

class PostRepository
{
    private $storage;

    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }

    public function findAll()
    {
        $posts = $this->storage->load();
        usort($posts, [$this, 'comparePostsByDate']);

        return $posts;
    }

    public function comparePostsByDate($postA, $postB)
    {
        return $postA['date'] < $postB['date'];
    }
}
