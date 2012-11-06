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
        $posts = $this->storage->load();
        $key = array_search($oldPost, $posts, true);

        if (false === $key) {
            throw new PostNotFoundException();
        }

        $posts[$key] = $newPost;
        $this->storage->store($posts);
    }

    public function delete(array $post)
    {
        $posts = $this->storage->load();
        $key = array_search($post, $posts, true);

        if (false === $key) {
            throw new PostNotFoundException();
        }

        unset($posts[$key]);
        $this->storage->store($posts);
    }
}
