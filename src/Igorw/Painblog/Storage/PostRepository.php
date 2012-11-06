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

    public function find($id)
    {
        $posts = $this->storage->load();
        foreach ($posts as $post) {
            if ($id === $post['id']) {
                return $post;
            }
        }

        throw new PostNotFoundException();
    }

    public function comparePostsByDateDesc($postA, $postB)
    {
        return strcmp($postB['date'], $postA['date']);
    }
}
