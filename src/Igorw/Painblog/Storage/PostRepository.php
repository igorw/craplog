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
        usort($posts, [$this, 'comparePostsByDateDesc']);

        return $posts;
    }

    public function comparePostsByDateDesc($postA, $postB)
    {
        return strcmp($postB['date'], $postA['date']);
    }
}
