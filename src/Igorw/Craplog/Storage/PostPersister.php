<?php

namespace Igorw\Craplog\Storage;

class PostPersister
{
    private $storage;

    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }

    public function save(array $post)
    {
        $posts = $this->storage->load();
        $posts[] = $post;
        $this->storage->store($posts);
    }
}
