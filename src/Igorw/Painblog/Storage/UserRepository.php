<?php

namespace Igorw\Painblog\Storage;

class UserRepository
{
    private $storage;

    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }

    public function findByName($name)
    {
        $users = $this->storage->load();
        foreach ($users as $user) {
            if ($name === $user['name']) {
                return $user;
            }
        }

        throw new UserNotFoundException();
    }
}
