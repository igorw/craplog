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

    public function update(array $oldPost, array $newPost)
    {
        $found = false;

        $posts = $this->storage->load();
        foreach ($posts as $i => $post) {
            if ($oldPost === $post) {
                $posts[$i] = $newPost;
                $found = true;
            }
        }

        if (!$found) {
            throw new PostNotFoundException();
        }

        $this->storage->store($posts);
    }
}
