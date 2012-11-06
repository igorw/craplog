<?php

namespace Igorw\Craplog\Security;

use Igorw\Craplog\Storage\UserRepository;
use Igorw\Craplog\Storage\UserNotFoundException;

class PlaintextAuthenticator
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function authenticate($name, $password)
    {
        try {
            $user = $this->userRepo->findByName($name);
            return $this->passwordsMatch($password, $user);
        } catch (UserNotFoundException $e) {
            return false;
        }
    }

    public function passwordsMatch($password, $user)
    {
        return $password === $user['password'];
    }
}
