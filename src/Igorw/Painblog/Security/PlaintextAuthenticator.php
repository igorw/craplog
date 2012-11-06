<?php

namespace Igorw\Painblog\Security;

use Igorw\Painblog\Storage\JsonStorage;

class PlaintextAuthenticator
{
    private $storage;

    public function __construct(JsonStorage $storage)
    {
        $this->storage = $storage;
    }

    public function authenticate($name, $password)
    {
        try {
            $user = $this->findUser($name);
            return $this->passwordsMatch($password, $user);
        } catch (UserNotFoundException $e) {
            return false;
        }
    }

    public function passwordsMatch($password, $user)
    {
        return $password === $user['password'];
    }

    public function findUser($name)
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
